<?php

use App\Http\Controllers\UserController;
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

    Route::post('/{post}/like', [\App\Http\Controllers\PostController::class, 'like'])
        ->middleware('auth:sanctum')
        ->name('posts.like');

    Route::put('/{post}/dislike', [\App\Http\Controllers\PostController::class, 'dislike'])
        ->middleware('auth:sanctum')
        ->name('posts.dislike');
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

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth:sanctum');

Route::post('/profile', [UserController::class, 'update'])
    ->middleware('auth:sanctum');