<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])
        ->name('posts.index');

    Route::post('/', [\App\Http\Controllers\PostController::class, 'store'])
        ->middleware('auth:sanctum')
        ->name('posts.store');

    Route::get('/{post}', [\App\Http\Controllers\PostController::class, 'show'])
        ->name('posts.show');
});

Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])
    ->name('register');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('login');

Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])
    ->middleware('auth:sanctum')
    ->name('user.index');
