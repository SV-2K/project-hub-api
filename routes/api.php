<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\AccountController;
use App\Http\Controllers\api\v1\TaskController;
use App\Http\Controllers\api\v1\CommentController;
use App\Http\Controllers\api\v1\NotificationController;

Route::prefix('/v1')
    ->group(function () {
        Route::controller(AccountController::class)
            ->group(function () {
                Route::post('/register', 'register');
                Route::post('/login', 'login');
            });

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('/logout', [AccountController::class, 'logout']);

                Route::get('/notifications', [NotificationController::class, 'index']);

                Route::apiResource('projects', ProjectController::class);
                Route::post('/projects/{project}/assign', [ProjectController::class, 'assign']);
                Route::post('/projects/{project}/unassign', [ProjectController::class, 'unassign']);

                Route::apiResource('projects.tasks', TaskController::class)
                    ->shallow();

                Route::apiResource('tasks.comments', CommentController::class)
                    ->except('show', 'update')
                    ->shallow();
        });
});
