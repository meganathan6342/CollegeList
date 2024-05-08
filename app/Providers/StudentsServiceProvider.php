<?php

namespace App\Providers;

use App\Repositories\StudentsRepository;
use App\Services\StudentsService;
use Illuminate\Support\ServiceProvider;

class StudentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentsService::class, function($app) {
            return new StudentsService($app->make(StudentsRepository::class));
        });

        $this->app->bind(StudentsRepository::class, function($app) {
            return new StudentsRepository();
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
