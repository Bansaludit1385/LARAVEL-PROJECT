<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function show($slug)
    {
        $quiz = Quiz::where('slug', $slug)->with('questions')->firstOrFail();
        
        // Ensure student is enrolled in the quiz's course
        if ($quiz->course_id) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $quiz->course_id)
                ->exists();
            if (!$isEnrolled) {
                return redirect()->route('courses.show', $quiz->course->slug)
                    ->with('error', 'You must be enrolled in the course to take the quiz.');
            }
        }

        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $user = Auth::user();
        $questions = $quiz->questions;

        $answers = $request->input('answers', []); // question_id => answer_index
        $correctCount = 0;
        $totalPoints = 0;
        $userPoints = 0;

        foreach ($questions as $q) {
            $totalPoints += $q->points;
            if (isset($answers[$q->id]) && (int)$answers[$q->id] === $q->correct_option) {
                $correctCount++;
                $userPoints += $q->points;
            }
        }

        // Calculate score percentage
        $scorePercent = $totalPoints > 0 ? ($userPoints / $totalPoints) * 100 : 100;
        $passed = $scorePercent >= $quiz->pass_percentage;

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $scorePercent,
            'passed' => $passed,
            'answers' => $answers,
        ]);

        if ($passed) {
            // Reward 50 base points + earned points
            $pointsAwarded = 50 + $userPoints;
            $user->increment('points', $pointsAwarded);

            // Check if course is complete to issue certificate!
            if ($quiz->course_id) {
                $enrollment = Enrollment::where('user_id', $user->id)
                    ->where('course_id', $quiz->course_id)
                    ->first();

                if ($enrollment && $enrollment->progress_percent === 100) {
                    Certificate::firstOrCreate([
                        'user_id' => $user->id,
                        'course_id' => $quiz->course_id,
                    ], [
                        'certificate_code' => 'CERT-' . strtoupper(Str::random(10)),
                        'issued_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('quizzes.result', $attempt->id);
    }

    public function result($attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions')->findOrFail($attemptId);

        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        return view('quizzes.result', compact('attempt'));
    }

    public function leaderboard(Request $request)
    {
        $query = User::withCount(['enrolledCourses', 'certificates']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('points', 'desc')->take(20)->get();
        return view('leaderboard', compact('users'));
    }
}
