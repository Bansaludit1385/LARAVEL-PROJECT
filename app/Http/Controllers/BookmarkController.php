<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'id' => 'required|integer',
        ]);

        $modelClass = $request->type;
        if (!class_exists($modelClass)) {
            return back()->with('error', 'Invalid bookmark type.');
        }

        $user = Auth::user();
        
        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', $modelClass)
            ->where('bookmarkable_id', $request->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $message = 'Removed from bookmarks.';
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'bookmarkable_type' => $modelClass,
                'bookmarkable_id' => $request->id,
            ]);
            $message = 'Added to bookmarks.';
        }

        return back()->with('success', $message);
    }
}
