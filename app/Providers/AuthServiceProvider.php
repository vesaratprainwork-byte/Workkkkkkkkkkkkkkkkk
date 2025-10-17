<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Provider;
use App\Models\Review;
use App\Models\User;
use App\Policies\GenrePolicy;
use App\Policies\MoviePolicy;
use App\Policies\ProviderPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Movie::class => MoviePolicy::class,
        Genre::class => GenrePolicy::class,
        Review::class => ReviewPolicy::class,
        Provider::class => ProviderPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
