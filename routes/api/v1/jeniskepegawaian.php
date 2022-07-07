<?php

use App\Http\Controllers\Admin\JenisKepegawaianController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/jeniskepegawaian', [JenisKepegawaianController::class, 'index']);
    Route::post('/jeniskepegawaian/delete_data', [JenisKepegawaianController::class, 'destroy']);
    // Route::post('/jeniskepegawaian/edit_data', [JenisKepegawaianController::class, 'edit']);
    Route::post('/jeniskepegawaian/adding_data', [JenisKepegawaianController::class, 'store']);
});

// Route::get('/users', [UserController::class, 'index']);