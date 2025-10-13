<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class ReviewController extends Controller
{
    use AuthorizesRequests; 

    public function create(Request $request, Movie $movie)
    {
        $this->authorize('create', Review::class); 

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('movie_id', $movie->id)
                                ->first();

        if ($existingReview) {
            return back()->withErrors(['alert' => 'You have already reviewed this movie.']);
        }

        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'movie_id' => $movie->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('status', 'Your review has been submitted successfully!');
    }

    
    public function delete(Review $review)
    {
        $this->authorize('delete', $review); 
        $review->delete();

        return back()->with('status', 'Review has been deleted successfully.');
    }
    
}