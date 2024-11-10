<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\RootController::class, 'root']);

Route::get('/claim', [App\Http\Controllers\ClaimController::class, 'claim']);

Route::post('/claim', [App\Http\Controllers\ClaimController::class, 'process_claim']);

Route::get('/success', [App\Http\Controllers\ClaimController::class, 'success']);

Route::get('/all-claims', [App\Http\Controllers\ClaimController::class, 'all_claims']);

Route::get('/about', [App\Http\Controllers\AboutController::class, 'about']);