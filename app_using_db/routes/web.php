<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Очень специфичный способ
// Route::resource('films', \App\Http\Controllers\FilmController::class)
//     // ->only(['index', 'show'])
//     // ->except(['...'])
//     ;

Route::prefix('/films')->group(function () {

    Route::get('', [\App\Http\Controllers\FilmController::class, 'index'])
        ->name('films');

    Route::get('/create', [\App\Http\Controllers\FilmController::class, 'create'])
        ->name('films.create');

    Route::post('/store', [\App\Http\Controllers\FilmController::class, 'store'])
        ->name('films.store');

    Route::get('/show', [\App\Http\Controllers\FilmController::class, 'show'])
        ->name('films.show');

});

Route::prefix('/directors')->group(function () {

    Route::get('', [\App\Http\Controllers\DirectorController::class, 'index'])
        ->name('directors');

    Route::get('/create', [\App\Http\Controllers\DirectorController::class, 'create'])
        ->name('directors.create');

    Route::post('/store', [\App\Http\Controllers\DirectorController::class, 'store'])
        ->name('directors.store');

    Route::get('/show', [\App\Http\Controllers\DirectorController::class, 'show'])
        ->name('directors.show');

});
