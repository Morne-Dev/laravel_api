<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\CompleteTaskController;

Route::prefix('api')->group(function () {
    
    // Authentication Routes
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class); // Login route
        Route::post('logout', LogoutController::class)->middleware('auth:sanctum'); // Logout route, requires auth
        Route::post('register', RegisterController::class); // Register route
    });

    // User Info Route, requires auth
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Versioned API Routes (v1)
    Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
        Route::apiResource('/tasks', TaskController::class); // Task resource routes
        Route::patch('/tasks/{task}/complete', CompleteTaskController::class); // Custom route to mark task as complete
    });

});
