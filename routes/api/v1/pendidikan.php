<?php

use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/pendidikan', [PendidikanController::class, 'index']);
    Route::post('/pendidikan/delete_data', [PendidikanController::class, 'destroy']);
    // Route::post('/pendidikan/edit_data', [PendidikanController::class, 'edit']);
    Route::post('/pendidikan/adding_data', [PendidikanController::class, 'store']);
});

// Route::get('/users', [UserController::class, 'index']);