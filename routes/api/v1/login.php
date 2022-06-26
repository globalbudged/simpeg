<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'index']);
// Route::get('/authenticated', [LoginController::class, 'check']);


Route::middleware('auth:sanctum')
->group( function(){

    Route::get('/authenticated', [LoginController::class, 'check']);
    Route::post('/logout', [LoginController::class, 'logout']);
});