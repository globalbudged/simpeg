<?php

use App\Http\Controllers\Admin\MutationController;
use App\Http\Controllers\Admin\MutasiDetailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
    ->group(function () {
        // Route::get('/mutasi', [MutationController::class, 'index']);
        // Route::get('/mutasi_by_uuid', [MutationController::class, 'data_by_uuid']);
        Route::post('/mutasidetail/adding_data', [MutasiDetailController::class, 'store']);
        Route::post('/mutasidetail/delete_data', [MutasiDetailController::class, 'destroy']);
        Route::post('/mutasidetail/del_mutasi_keluar', [MutasiDetailController::class, 'del_mutasi_keluar']);
        Route::post('/mutasidetail/del_mutasi_antar', [MutasiDetailController::class, 'del_mutasi_antar']);
    });
