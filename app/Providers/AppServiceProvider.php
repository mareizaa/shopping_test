<?php

namespace App\Providers;

use App\Repositories\BuyRepository;
use App\Services\BuyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BuyRepository::class, function ($app) {
            return new BuyRepository();
        });

        $this->app->bind(BuyService::class, function ($app) {
            return new BuyService($app->make(BuyRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
