<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('articles')->get();
        $tags = Tag::all();

        $query = Article::where('status', 'published')
            ->with(['author', 'category', 'tags'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $articles = $query->paginate(8)->withQueryString();

        return view('articles.index', compact('articles', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author', 'category', 'tags', 'comments.user'])
            ->firstOrFail();

        // Increment view count securely
        $article->increment('views_count');

        // Check if bookmarked
        $isBookmarked = false;
        if (Auth::check()) {
            $isBookmarked = Auth::user()->bookmarks()
                ->where('bookmarkable_type', Article::class)
                ->where('bookmarkable_id', $article->id)
                ->exists();
        }

        // Generate dynamic outline / Table of Contents by regex parsing headings (h2/h3) from markdown
        preg_match_all('/^(##|###) (.*$)/m', $article->content, $matches);
        $headings = [];
        if (!empty($matches[2])) {
            foreach ($matches[2] as $index => $title) {
                $level = strlen($matches[1][$index]); // 2 for ##, 3 for ###
                $headings[] = [
                    'title' => trim($title),
                    'slug' => Str::slug($title),
                    'level' => $level
                ];
            }
        }

        return view('articles.show', compact('article', 'isBookmarked', 'headings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        $article = Article::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . rand(100, 999),
            'content' => $request->content,
            'status' => Auth::user()->isAdmin() ? 'published' : 'pending',
        ]);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect()->route('articles.index')
            ->with('success', Auth::user()->isAdmin() ? 'Article published!' : 'Article submitted for moderation.');
    }
}
