<?php

use App\Http\Controllers\Admin\JabatanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan/delete_data', [JabatanController::class, 'destroy']);
    Route::post('/jabatan/adding_data', [JabatanController::class, 'store']);
});
