<?php

use App\Http\Controllers\Admin\MutationController;
use App\Http\Controllers\Admin\MutasiDetailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    // Route::get('/mutasi', [MutationController::class, 'index']);
    // Route::get('/mutasi_by_uuid', [MutationController::class, 'data_by_uuid']);
    Route::post('/mutasidetail/adding_data', [MutasiDetailController::class, 'store']);
    Route::post('/mutasidetail/delete_data', [MutasiDetailController::class, 'destroy']);
});
