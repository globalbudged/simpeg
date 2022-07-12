<?php

use App\Http\Controllers\Set\AutoComplete;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cache_response'])
->group( function(){
    Route::get('/autocomplete', [AutoComplete::class, 'index']);
    Route::get('/autocomplete_jurusans', [AutoComplete::class, 'jurusans']);
    Route::get('/autocomplete_jabatans', [AutoComplete::class, 'jabatans']);
    Route::get('/autocomplete_golongans', [AutoComplete::class, 'golongans']);
    Route::get('/autocomplete_ruangans', [AutoComplete::class, 'ruangans']);
    Route::get('/autocomplete_bagians', [AutoComplete::class, 'bagians']);
});

// Route::get('/users', [UserController::class, 'index']);