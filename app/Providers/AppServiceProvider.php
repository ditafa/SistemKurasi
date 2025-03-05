<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

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
        // Set Locale Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Set Locale PHP ke Bahasa Indonesia
        setlocale(LC_TIME, 'id_ID.UTF-8');

        // Pastikan default string length agar tidak error di beberapa database
        Schema::defaultStringLength(191);
    }
}
