<?php

namespace App\Http\Controllers;

use App\Models\PracticeProblem;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * Display a listing of coding problems.
     */
    public function index(Request $request)
    {
        $query = PracticeProblem::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        // Difficulty filter
        if ($request->filled('difficulty') && in_array(strtolower($request->difficulty), ['easy', 'medium', 'hard'])) {
            $query->where('difficulty', strtolower($request->difficulty));
        }

        $problems = $query->orderBy('id', 'asc')->get();

        // Stats counters for cards
        $easyCount = PracticeProblem::where('difficulty', 'easy')->count();
        $mediumCount = PracticeProblem::where('difficulty', 'medium')->count();
        $hardCount = PracticeProblem::where('difficulty', 'hard')->count();

        return view('practice.index', compact('problems', 'easyCount', 'mediumCount', 'hardCount'));
    }

    /**
     * Display a specific coding problem and compiler sandbox.
     */
    public function show($slug)
    {
        $problem = PracticeProblem::where('slug', $slug)->firstOrFail();

        return view('practice.show', compact('problem'));
    }
}
