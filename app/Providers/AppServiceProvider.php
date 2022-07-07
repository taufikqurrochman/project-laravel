<?php

namespace App\Providers;

// agar function gate dapat digunakan
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

// agar bootstrap paginator dapat dipakai
use Illuminate\Pagination\Paginator;

use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // agar pagination menggunakan bootstrap
        Paginator::useBootstrap();

        // agar menggunakan gate
        // Gate::define('admin', function(User $user){
        //     return $user->username === 'taufik';

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });
    }
}
