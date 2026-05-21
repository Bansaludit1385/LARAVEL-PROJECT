<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Enrollment;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $tags = \App\Models\Tag::all();
        
        $query = Course::where('is_published', true)->with(['instructor', 'category', 'tags']);

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        if ($request->filled('price')) {
            if ($request->price === 'free') {
                $query->where('price', 0);
            } else {
                $query->where('price', '>', 0);
            }
        }

        $courses = $query->paginate(6)->withQueryString();

        return view('courses.index', compact('courses', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['instructor', 'category', 'lessons', 'quizzes'])
            ->firstOrFail();

        $isEnrolled = false;
        $progress = 0;

        if (Auth::check()) {
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
            
            if ($enrollment) {
                $isEnrolled = true;
                $progress = $enrollment->progress_percent;
            }
        }

        return view('courses.show', compact('course', 'isEnrolled', 'progress'));
    }

    public function enroll($id)
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();

        // Check if course is paid
        if ($course->price > 0) {
            $isAlreadyEnrolled = Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->exists();

            if (!$isAlreadyEnrolled) {
                return redirect()->route('courses.checkout', $course->slug);
            }
        }

        // Allow immediate enrollment if free or if already paid
        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.lesson', [$course->slug, $course->lessons->first()->slug ?? 'intro'])
            ->with('success', 'Enrolled successfully! Ready to learn.');
    }

    public function checkout($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        // If user already enrolled, redirect to lesson
        $isAlreadyEnrolled = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($isAlreadyEnrolled) {
            return redirect()->route('courses.lesson', [$course->slug, $course->lessons->first()->slug ?? 'intro']);
        }

        return view('courses.checkout', compact('course'));
    }

    public function processCheckout(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        $request->validate([
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|min:16|max:19',
            'card_expiry' => 'required|string',
            'card_cvv' => 'required|string|digits:3',
        ]);

        // Complete the mock enrollment (representing success payment)
        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.lesson', [$course->slug, $course->lessons->first()->slug ?? 'intro'])
            ->with('success', "Payment of $" . number_format($course->price, 2) . " processed successfully! You are now enrolled.");
    }

    public function lesson($courseSlug, $lessonSlug)
    {
        $course = Course::where('slug', $courseSlug)->with(['lessons', 'quizzes'])->firstOrFail();
        
        // Ensure student is enrolled
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        $lesson = Lesson::where('course_id', $course->id)
            ->where('slug', $lessonSlug)
            ->firstOrFail();

        // Get comments
        $comments = $lesson->comments()->with('user')->orderBy('created_at', 'desc')->get();

        // Check if lesson is marked complete
        $isCompleted = Auth::user()->completedLessons()->where('lesson_id', $lesson->id)->exists();

        return view('courses.lesson', compact('course', 'lesson', 'comments', 'isCompleted', 'enrollment'));
    }

    public function completeLesson(Request $request, $courseSlug, $lessonId)
    {
        $user = Auth::user();
        $lesson = Lesson::findOrFail($lessonId);
        $course = $lesson->course;

        // Toggle / attach completion
        $user->completedLessons()->syncWithoutDetaching([$lessonId]);

        // Calculate progress percentage
        $totalLessons = $course->lessons()->count();
        $completedCount = $user->completedLessons()->whereIn('lesson_id', $course->lessons->pluck('id'))->count();
        
        $progress = $totalLessons > 0 ? (int) (($completedCount / $totalLessons) * 100) : 100;

        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            $enrollment->progress_percent = $progress;
            if ($progress === 100 && !$enrollment->completed_at) {
                $enrollment->completed_at = now();
                
                // If there's no quiz, or if the user has already passed the quiz, issue certificate!
                $hasPassedQuiz = false;
                if ($course->quizzes()->count() > 0) {
                    $quizIds = $course->quizzes()->pluck('id');
                    $hasPassedQuiz = \App\Models\QuizAttempt::where('user_id', $user->id)
                        ->whereIn('quiz_id', $quizIds)
                        ->where('passed', true)
                        ->exists();
                }

                if ($course->quizzes()->count() === 0 || $hasPassedQuiz) {
                    Certificate::firstOrCreate([
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                    ], [
                        'certificate_code' => 'CERT-' . strtoupper(Str::random(10)),
                        'issued_at' => now(),
                    ]);
                    $user->increment('points', 100); // 100 bonus points!
                }
            }
            $enrollment->save();
        }

        // Find next lesson
        $nextLesson = $course->lessons()
            ->where('sort_order', '>', $lesson->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($nextLesson) {
            return redirect()->route('courses.lesson', [$course->slug, $nextLesson->slug])
                ->with('success', 'Lesson marked complete! Let\'s proceed.');
        }

        // If no more lessons, redirect to course summary or quiz!
        if ($course->quizzes()->count() > 0) {
            return redirect()->route('courses.show', $course->slug)
                ->with('info', 'Congratulations! You finished all lessons. Now complete the Final Assessment quiz to unlock your certificate!');
        }

        return redirect()->route('courses.show', $course->slug)
            ->with('success', 'Masterpiece completed! Your official certificate is ready in your profile.');
    }
}
