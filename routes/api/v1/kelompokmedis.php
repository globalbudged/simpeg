<?php

use App\Http\Controllers\Admin\KelompokMedisController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/kelompokmedis', [KelompokMedisController::class, 'index']);
    Route::post('/kelompokmedis/delete_data', [KelompokMedisController::class, 'destroy']);
    Route::post('/kelompokmedis/adding_data', [KelompokMedisController::class, 'store']);
});
