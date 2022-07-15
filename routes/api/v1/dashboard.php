<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Set\AutoComplete;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/logs_all', [DashboardController::class, 'logs_all']);
    });

// Route::get('/users', [UserController::class, 'index']);