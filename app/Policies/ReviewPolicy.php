<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * อนุญาตให้ User ทุกคนสร้างรีวิวได้
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * อนุญาตให้ User แก้ไขได้เฉพาะรีวิวของตัวเองเท่านั้น
     */
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * อนุญาตให้ User ลบได้เฉพาะรีวิวของตัวเอง หรือถ้าเป็น Admin ก็ลบได้ทั้งหมด
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id || $user->role === 'ADMIN';
    }
}