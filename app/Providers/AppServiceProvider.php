<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

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
        Schema::defaultStringLength(191);

        // AUTO-REFRESH HACK FOR LOCAL DEVELOPMENT
        // If we are in local mode, clear the cache automatically on every page load.
        // This saves you from typing into the terminal constantly.
        if (App::environment('local')) {
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            // We don't clear 'config' or 'cache' here because it makes the site too slow.
            // But clearing routes and views covers 99% of your changes!
        }
    }
}