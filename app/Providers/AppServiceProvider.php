<?php

namespace App\Providers;

use App\Http\Resources\User\AccountResource;
use App\Services\AccountService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('account_service', AccountService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AccountResource::withoutWrapping();
    }
}
