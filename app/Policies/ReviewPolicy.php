<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    
    public function create(User $user): bool
    {
        return true;
    }

    
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id || $user->role === 'ADMIN';
    }
}