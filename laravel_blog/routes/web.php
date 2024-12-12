<?php

use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function() {

    Route::get('/', [\App\Http\Controllers\PostController::class, 'welcome'])
        ->name('welcome');

});

Route::prefix('/api')->group(function() {

    Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'all']);

});

Route::prefix('/posts')->group(function() {

    Route::post('/create', [\App\Http\Controllers\PostController::class, 'store'])
        ->name('posts.store');

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

