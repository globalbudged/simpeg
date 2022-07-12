<?php

use App\Http\Controllers\Admin\MutationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
->group( function(){
    Route::get('/mutasi', [MutationController::class, 'index']);
    Route::get('/mutasi_by_uuid', [MutationController::class, 'data_by_uuid']);
    Route::get('/mutasi/set_status', [MutationController::class, 'set_status']);
    Route::post('/mutasi/adding_data', [MutationController::class, 'store']);
    Route::post('/mutasi/delete_data', [MutationController::class, 'destroy']);
});
