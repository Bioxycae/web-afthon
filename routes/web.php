<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallAdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [PostController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class)->except(['index', 'show']);
});

Route::middleware('no.admin')->group(function () {
    Route::get('/install-admin', [InstallAdminController::class, 'index'])->name('install.admin');
    Route::post('/install-admin', [InstallAdminController::class, 'store'])->name('install.admin.store');
});

require __DIR__.'/auth.php';
