<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\AccountController;
use App\Http\Controllers\api\v1\TaskController;
use App\Http\Controllers\api\v1\CommentController;

Route::prefix('/v1')->group(function () {
    Route::controller(AccountController::class)
        ->withoutMiddleware('auth:sanctum')
        ->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::get('/logout', 'logout');
    });

    Route::apiResource('projects', ProjectController::class);
    Route::post('/projects/{project}/assign', [ProjectController::class, 'assign']);

    Route::apiResource('tasks', TaskController::class);

    Route::apiResource('comments', CommentController::class)
        ->except('show', 'update');
});
