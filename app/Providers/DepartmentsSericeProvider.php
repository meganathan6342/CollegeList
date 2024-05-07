<?php

namespace App\Providers;

use App\Repositories\DepartmentsRepository;
use App\Services\DepartmentsService;
use Illuminate\Support\ServiceProvider;

class DepartmentsSericeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepartmentsService::class, function($app) {
            return new DepartmentsService($app->make(DepartmentsRepository::class));
        });

        $this->app->bind(DepartmentsRepository::class, function($app) {
            return new DepartmentsRepository();
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
