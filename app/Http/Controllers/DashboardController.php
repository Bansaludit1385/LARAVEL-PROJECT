<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Article;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        if ($user->isInstructor()) {
            return $this->instructorDashboard();
        }

        return $this->studentDashboard();
    }

    private function studentDashboard()
    {
        $user = Auth::user();
        
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.lessons'])
            ->get();

        $certificates = $user->certificates()->with('course')->get();
        $quizAttempts = $user->quizAttempts()->with('quiz.course')->get();

        // Calculate progress numbers for Chart.js
        $totalMinutes = 0;
        foreach ($user->completedLessons as $l) {
            $totalMinutes += $l->duration_minutes;
        }

        $bookmarks = $user->bookmarks()->with('bookmarkable')->get();

        return view('dashboard.student', compact('enrollments', 'certificates', 'quizAttempts', 'totalMinutes', 'bookmarks'));
    }

    private function instructorDashboard()
    {
        $user = Auth::user();
        
        $courses = Course::where('user_id', $user->id)
            ->withCount(['students', 'lessons'])
            ->get();

        $totalStudents = $courses->sum('students_count');
        $totalLessons = $courses->sum('lessons_count');
        
        // Calculate dynamic mock earnings ($20 per student enrollment)
        $totalEarnings = $courses->sum(function($c) {
            return $c->students_count * 20;
        });

        $recentEnrollments = Enrollment::whereIn('course_id', $courses->pluck('id'))
            ->with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.instructor', compact('courses', 'totalStudents', 'totalLessons', 'totalEarnings', 'recentEnrollments'));
    }

    private function adminDashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalArticles = Article::count();
        $pendingArticles = Article::where('status', 'pending')->with('author')->get();
        
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.admin', compact('totalUsers', 'totalCourses', 'totalArticles', 'pendingArticles', 'users'));
    }

    public function toggleUserRole(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $request->validate([
            'role' => 'required|in:admin,instructor,student',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "User role updated successfully for {$user->name}.");
    }

    public function approveArticle($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $article = Article::findOrFail($id);
        $article->status = 'published';
        $article->save();

        // Grant author 50 points!
        $article->author->increment('points', 50);

        return back()->with('success', 'Article approved and published! Author rewarded with 50 points.');
    }

    public function adminUsers(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $query = User::withCount(['enrolledCourses', 'completedLessons', 'quizAttempts']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('gender', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Core stats
        $totalUsers = User::count();
        $studentCount = User::where('role', 'student')->count();
        $instructorCount = User::where('role', 'instructor')->count();
        $adminCount = User::where('role', 'admin')->count();

        // Fetch support messages
        $supportMessages = \App\Models\SupportMessage::orderBy('created_at', 'desc')->get();

        return view('admin.users', compact('users', 'totalUsers', 'studentCount', 'instructorCount', 'adminCount', 'supportMessages'));
    }

    public function deleteSupportMessage($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $msg = \App\Models\SupportMessage::findOrFail($id);
        $msg->delete();

        return back()->with('success', 'Support inquiry has been deleted successfully.');
    }

    public function deleteUser($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own admin account.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User account for {$userName} has been successfully deleted.");
    }
}
