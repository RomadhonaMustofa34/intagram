<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ArchiveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/profile', [ProfilController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');



// Route halaman profil dengan feed
Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
Route::get('/feed/create', [FeedController::class, 'create'])->name('feed.create');

Route::post('/feed/upload', [FeedController::class, 'upload'])->name('feed.upload');

Route::get('/feed/{id}/edit', [FeedController::class, 'edit'])->name('feed.edit');
Route::put('/feed/{id}', [FeedController::class, 'update'])->name('feed.update');


Route::middleware('auth')->group(function () {
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
    Route::get('/archive/download', [ArchiveController::class, 'download'])->name('archive.download');
});

Route::post('/feeds/{id}/like', [FeedController::class, 'Like'])->name('feed.like');
