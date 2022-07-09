<?php

use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::post('/pegawai/delete_data', [PegawaiController::class, 'destroy']);
    // Route::post('/pegawai/edit_data', [PegawaiController::class, 'edit']);
    Route::post('/pegawai/adding_data', [PegawaiController::class, 'store']);
    Route::post('/pegawai/checking', [PegawaiController::class, 'checking']);
});

// Route::get('/users', [UserController::class, 'index']);