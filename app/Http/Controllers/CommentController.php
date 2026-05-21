<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'content' => 'required|string|max:1000',
        ]);

        $modelClass = $request->commentable_type;
        if (!class_exists($modelClass)) {
            return back()->with('error', 'Invalid comment type.');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'commentable_type' => $modelClass,
            'commentable_id' => $request->commentable_id,
            'content' => $request->content,
        ]);

        // Reward points to student for contributing to discussions!
        Auth::user()->increment('points', 5);

        return back()->with('success', 'Comment posted! Earned 5 learning points.');
    }
}
