<?php

use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function() {

    Route::get('/', [\App\Http\Controllers\PostController::class, 'welcome'])
        ->name('welcome');

});

Route::prefix('/auth')->group(function () {


    Route::get('/signin', [\App\Http\Controllers\AuthController::class, 'signin_page'])
        ->name('signin_page');

    Route::post('/signin', [\App\Http\Controllers\AuthController::class, 'signin'])
        ->name('signin');

    Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'signup_page'])
        ->name('signup_page');

    Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'signup'])
        ->name('signup');

});

