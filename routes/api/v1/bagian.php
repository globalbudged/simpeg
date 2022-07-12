<?php

use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\API\V1\BagianController as V1BagianController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
->group( function(){
    Route::get('/bagian', [BagianController::class, 'index']);
    Route::post('/bagian/delete_data', [BagianController::class, 'destroy']);
    Route::post('/bagian/adding_data', [BagianController::class, 'store']);
    // Route::apiResource('bagian', V1BagianController::class);
});
