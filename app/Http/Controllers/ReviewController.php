<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You need to be logged in to leave a review'], 401);
        }

        $validated = $request->validate([
            'titleReview' => 'required|max:255',
            'content' => 'required',
            'grade' => 'required|integer',
            'event_id' => 'required|integer',
        ]);

        $review = new Avis;
        $review->titleReview = $validated['titleReview'];
        $review->content = $validated['content'];
        $review->grade = $validated['grade'];
        $review->event_id = $validated['event_id'];
        $review->user_id = auth()->id();
        $review->save();

        return redirect()->route('events.show', ['event' => $validated['event_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Avis $avis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avis $avis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avis $avis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avis $avis)
    {
        //
    }
}
