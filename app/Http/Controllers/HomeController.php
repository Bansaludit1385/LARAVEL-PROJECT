<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['courses', 'articles'])->get();
        $tags = Tag::take(12)->get();
        
        $featuredCourses = Course::where('is_published', true)
            ->with(['instructor', 'category'])
            ->withCount('students')
            ->orderBy('students_count', 'desc')
            ->take(3)
            ->get();

        $recentArticles = Article::where('status', 'published')
            ->with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $trendingArticles = Article::where('status', 'published')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('home', compact('categories', 'tags', 'featuredCourses', 'recentArticles', 'trendingArticles'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $courses = Course::where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['instructor', 'category'])
            ->take(6)
            ->get();

        $articles = Article::where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->with(['author', 'category'])
            ->take(6)
            ->get();

        return view('search', compact('courses', 'articles', 'query'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $msgContent = $request->input('message');

        // Always save to database so the messages are never lost
        \App\Models\SupportMessage::create([
            'name' => $name,
            'email' => $email,
            'message' => $msgContent,
        ]);

        try {
            \Illuminate\Support\Facades\Mail::raw(
                "You received a new support ticket from CodeSpire contact form:\n\n" .
                "Sender Name: {$name}\n" .
                "Sender Email: {$email}\n\n" .
                "Message:\n{$msgContent}",
                function ($message) use ($email, $name) {
                    $message->to('budit1385@gmail.com')
                        ->subject('CodeSpire Support Ticket from ' . $name)
                        ->replyTo($email, $name);
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Support mail delivery failed: ' . $e->getMessage(), [
                'name' => $name,
                'email' => $email,
                'message' => $msgContent,
            ]);
        }

        return redirect()->route('contact')
            ->with('success', 'Thank you! Your support message has been sent successfully to our administrator.');
    }
}
