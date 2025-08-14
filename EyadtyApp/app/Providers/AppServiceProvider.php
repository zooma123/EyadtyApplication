<?php

namespace App\Providers;

use App\Services\AuthServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServices::class, function ($app) {
            return new AuthServices();
        });
    }

   
    public function boot(): void
    {
        
    }
}
