<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Service Pattern Registration
        $this->app->singleton(\App\Services\FoodService::class);
        $this->app->singleton(\App\Services\NutritionApiService::class);
        $this->app->singleton(\App\Services\NutritionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
