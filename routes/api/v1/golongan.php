<?php

use App\Http\Controllers\Admin\GolonganController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
->group( function(){
    Route::get('/golongan', [GolonganController::class, 'index']);
    Route::post('/golongan/delete_data', [GolonganController::class, 'destroy']);
    Route::post('/golongan/adding_data', [GolonganController::class, 'store']);
});
