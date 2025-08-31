<?php

// routes/web.php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // New search route
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('users.follow');

    Route::get('/users/{user}/following', [UserController::class, 'following'])->name('users.following');
    Route::get('/users/{user}/followers', [UserController::class, 'followers'])->name('users.followers');
    Route::get('/explore', [UserController::class, 'explore'])->name('users.explore');
});

require __DIR__.'/auth.php';
