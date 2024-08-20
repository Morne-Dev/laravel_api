<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
});