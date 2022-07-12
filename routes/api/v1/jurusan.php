<?php

use App\Http\Controllers\Admin\JurusanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
->group( function(){
    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::post('/jurusan/delete_data', [JurusanController::class, 'destroy']);
    Route::post('/jurusan/adding_data', [JurusanController::class, 'store']);
});
