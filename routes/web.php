<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ArchiveController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

// Routes untuk login dan register
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Group route yang memerlukan otentikasi
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profil
    Route::get('/profile', [ProfilController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');
    
    // Feed Routes
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::get('/feed/create', [FeedController::class, 'create'])->name('feed.create');
    Route::post('/feed/upload', [FeedController::class, 'upload'])->name('feed.upload');
    Route::get('/feed/{id}/edit', [FeedController::class, 'edit'])->name('feed.edit');
    Route::put('/feed/{id}', [FeedController::class, 'update'])->name('feed.update');
    Route::delete('/feed/{id}', [FeedController::class, 'destroy'])->name('feed.destroy');
    Route::post('/feeds/{id}/like', [FeedController::class, 'like'])->name('feed.like');
    
    // Archive Routes
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
    Route::get('/archive/download', [ArchiveController::class, 'download'])->name('archive.download');
});

