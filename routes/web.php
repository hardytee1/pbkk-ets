<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::patch('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    Route::get('user/bio/{id}', [BlogController::class, 'show'])->name('bio.show');
    Route::patch('/user/bio/create/{user}', [BlogController::class, 'bio_store'])->name('bio.store');

    Route::post('/like/{blog}', [LikesController::class, 'store'])->name('like.store');
    Route::post('/like/bio/{blog}', [LikesController::class, 'bio_store'])->name('like.bio_store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
