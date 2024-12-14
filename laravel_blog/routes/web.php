<?php

use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function() {

    Route::get('/', [\App\Http\Controllers\PostController::class, 'welcome'])
        ->name('welcome');

});

Route::prefix('/api')->group(function() {

    Route::get('/posts', [\App\Http\Controllers\ApiController::class, 'posts']);

    Route::get('/comments', [\App\Http\Controllers\ApiController::class, 'comments']);

    Route::get('/statuses', [\App\Http\Controllers\ApiController::class, 'statuses']);

});

Route::prefix('/posts')->group(function() {

    Route::post('/create', [\App\Http\Controllers\PostController::class, 'store'])
        ->name('posts.store');

    Route::delete('/{id}/delete', [\App\Http\Controllers\PostController::class, 'delete'])
        ->name('posts.delete');

});

Route::prefix('/moderate')->group(function() {

    Route::get('', [\App\Http\Controllers\ModerateController::class, 'index'])
        ->name('moderate.index');

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

