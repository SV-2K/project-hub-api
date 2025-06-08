<?php

namespace App\Providers;

use App\Http\Resources\User\AccountResource;
use App\Services\AccountService;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('account_service', AccountService::class);
        $this->app->bind('project_service', ProjectService::class);
        $this->app->bind('task_service', TaskService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AccountResource::withoutWrapping();
    }
}
