<?php

namespace App\Providers;

use App\Repositories\CollegesRepository;
use App\Services\CollegesService;
use Illuminate\Support\ServiceProvider;

class CollegesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CollegesService::class, function($app) {
            return new CollegesService($app->make(CollegesRepository::class));
        });

        $this->app->bind(CollegesRepository::class, function($app) {
            return new CollegesRepository();
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
