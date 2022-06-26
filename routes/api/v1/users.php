<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/me', [UserController::class, 'me']);
});

// Route::get('/users', [UserController::class, 'index']);