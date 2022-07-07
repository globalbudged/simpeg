<?php

use App\Http\Controllers\Admin\RuanganController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::post('/ruangan/delete_data', [RuanganController::class, 'destroy']);
    Route::post('/ruangan/adding_data', [RuanganController::class, 'store']);
});
