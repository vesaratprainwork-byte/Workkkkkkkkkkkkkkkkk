<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GenrePolicy
{
    
    public function viewAny(User $user): bool
    {
        return true;
    }

    
    public function view(User $user, Genre $genre): bool
    {
        return true;
    }

    
    public function create(User $user): bool
    {
        return $user->role === 'ADMIN';
    }

    
    public function update(User $user, Genre $genre): bool
    {
        return $user->role === 'ADMIN';
    }

    
    public function delete(User $user, Genre $genre): bool
    {
        return $user->role === 'ADMIN';
    }
}