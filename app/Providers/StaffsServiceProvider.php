<?php

namespace App\Providers;

use App\Repositories\StaffsRepository;
use App\Services\StaffsService;
use Illuminate\Support\ServiceProvider;

class StaffsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StaffsService::class, function($app) {
            return new StaffsService($app->make(StaffsRepository::class));
        });

        $this->app->bind(StaffsRepository::class, function($app) {
            return new StaffsRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
