<?php

use App\Http\Controllers\Set\AutoComplete;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
->group( function(){
    Route::get('/autocomplete', [AutoComplete::class, 'index']);
    Route::get('/autocomplete_jurusans', [AutoComplete::class, 'jurusans']);
});

// Route::get('/users', [UserController::class, 'index']);