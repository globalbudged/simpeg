<?php

use App\Http\Controllers\Admin\MutationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/mutasi', [MutationController::class, 'index']);
    Route::post('/mutasi/adding_data', [MutationController::class, 'store']);
    Route::post('/mutasi/delete_data', [MutationController::class, 'destroy']);
});
