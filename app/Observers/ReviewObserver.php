<?php

namespace App\Observers;

use App\Models\Movie;
use App\Models\Review;

class ReviewObserver
{
    /**
     * ทำงานหลังจากมีการสร้าง Review ใหม่
     */
    public function created(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }

    /**
     * ทำงานหลังจากมีการอัปเดต Review (เผื่ออนาคต)
     */
    public function updated(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }

    /**
     * ทำงานหลังจากมีการลบ Review
     */
    public function deleted(Review $review): void
    {
        $this->updateMovieRating($review->movie);
    }

    /**
     * ฟังก์ชันสำหรับคำนวณและอัปเดตคะแนนเฉลี่ยของหนัง
     */
    protected function updateMovieRating(Movie $movie)
    {
        $movie->average_rating = $movie->reviews()->avg('rating') ?? 0;
        $movie->reviews_count = $movie->reviews()->count();
        $movie->save();
    }
}