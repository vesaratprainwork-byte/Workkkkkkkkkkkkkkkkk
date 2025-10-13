<?php

namespace App\Policies;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProviderPolicy
{
    
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'ADMIN') {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return false; 
    }

    public function view(User $user, Provider $provider): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Provider $provider): bool
    {
        return false;
    }

    public function delete(User $user, Provider $provider): bool
    {
        return false;
    }
}