<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;

// Public Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/leaderboard', [QuizController::class, 'leaderboard'])->name('leaderboard');

// Practice Problems Routes
Route::get('/practice', [PracticeController::class, 'index'])->name('practice.index');
Route::get('/practice/{slug}', [PracticeController::class, 'show'])->name('practice.show');

// Course Public Routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

// Article Public Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Public Certificate Verification Route
Route::get('/certificates/{code}', [CertificateController::class, 'show'])->name('certificates.show');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Redirection or role-based rendering Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Enrollment & Learning Player
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/courses/{slug}/checkout', [CourseController::class, 'checkout'])->name('courses.checkout');
    Route::post('/courses/{slug}/checkout', [CourseController::class, 'processCheckout'])->name('courses.checkout.process');
    Route::get('/courses/{courseSlug}/lessons/{lessonSlug}', [CourseController::class, 'lesson'])->name('courses.lesson');
    Route::post('/courses/{courseSlug}/lessons/{lessonId}/complete', [CourseController::class, 'completeLesson'])->name('courses.complete-lesson');

    // Quizzes & Assessments
    Route::get('/quizzes/{slug}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/attempt/{attemptId}/result', [QuizController::class, 'result'])->name('quizzes.result');

    // Article Submissions by Instructors/Authors
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // Comments & Bookmarks
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

    // Admin Specific Operations
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/users', [DashboardController::class, 'adminUsers'])->name('admin.users');
        Route::post('/admin/users/{id}/role', [DashboardController::class, 'toggleUserRole'])->name('admin.users.role');
        Route::delete('/admin/users/{id}', [DashboardController::class, 'deleteUser'])->name('admin.users.delete');
        Route::delete('/admin/support/{id}', [DashboardController::class, 'deleteSupportMessage'])->name('admin.support.delete');
        Route::post('/admin/articles/{id}/approve', [DashboardController::class, 'approveArticle'])->name('admin.approve-article');
    });
});

require __DIR__.'/auth.php';
