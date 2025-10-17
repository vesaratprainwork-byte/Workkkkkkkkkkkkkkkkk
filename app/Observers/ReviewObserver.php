<?php

namespace App\Observers;

use App\Models\Movie;
use App\Models\Review;

class ReviewObserver
{

    public function created(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }


    public function updated(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }


    public function deleted(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }


    protected function updateMovieRating(Movie $movie)
    {
        $movie->average_rating = $movie->reviews()->avg('rating') ?? 0;
        $movie->reviews_count = $movie->reviews()->count();
        $movie->save();
    }
}
