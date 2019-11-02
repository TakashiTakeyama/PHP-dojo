<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (\DB::getDriverName() === 'sqlite') {
            \DB::statement(\DB::raw('PRAGMA foreign_keys=1'));
        }
    }
}
