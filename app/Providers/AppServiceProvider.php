<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Define a global rate limiter that limits requests to 100 per minute
         * based on the user's IP address. This is useful to prevent abuse or
         * excessive requests to the application.
         */
        RateLimiter::for('global', function ($request) {
            return Limit::perMinute(100)->by($request->ip());
        });
    }
}
