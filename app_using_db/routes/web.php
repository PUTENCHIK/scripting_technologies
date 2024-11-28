<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Очень специфичный способ 
Route::resource('films', \App\Http\Controllers\FilmController::class)
    // ->only(['index', 'show'])
    // ->except(['...'])
    ;

