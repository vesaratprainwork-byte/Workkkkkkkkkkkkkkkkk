<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;




use App\Models\User;
use App\Policies\UserPolicy;



class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        \Illuminate\Pagination\Paginator
            ::defaultView('vendor.pagination.default');
        \Illuminate\Pagination\Paginator
            ::defaultSimpleView('vendor.pagination.simple-default');

        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.default');
        \Illuminate\Pagination\Paginator::defaultSimpleView('vendor.pagination.simple-default');

        Gate::policy(User::class, UserPolicy::class);
    }
}
