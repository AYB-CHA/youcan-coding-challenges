<?php

namespace App\Providers;

use App\Services\Validation\Contracts\CategoryValidationServiceInterface;
use App\Services\Validation\Contracts\ProductValidationServiceInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Services\Validation\CategoryValidationService;
use App\Services\Validation\ProductValidationService;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        // Services
        $this->app->bind(
            ProductValidationServiceInterface::class,
            ProductValidationService::class,
        );
        $this->app->bind(
            CategoryValidationServiceInterface::class,
            CategoryValidationService::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 
    }
}
