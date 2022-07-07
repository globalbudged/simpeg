<?php

use App\Http\Controllers\Admin\BagianController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/bagian', [BagianController::class, 'index']);
    Route::post('/bagian/delete_data', [BagianController::class, 'destroy']);
    Route::post('/bagian/adding_data', [BagianController::class, 'store']);
});
