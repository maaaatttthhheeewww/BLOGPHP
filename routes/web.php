<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\BlogController;
use App\Models\Blog;

Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/authored', [BlogController::class, 'authored'])->name('MyBlogs');

Route::delete('/blogs/authored/{id}', [BlogController::class, 'destroy'])->name('DestroyBlog');
Route::patch('/blogs/authored/{id}', [BlogController::class, 'update'])->name('UpdateBlog');


Route::get('/blogs/create', [BlogController::class, 'create'])->name('BlogCreateRoute');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
