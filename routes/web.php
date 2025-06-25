<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PuisiController;
use Illuminate\Support\Facades\Route;

// Auth Route
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Route
Route::resource('genres', GenreController::class)->middleware('auth');
Route::get('/puisis/my', [PuisiController::class, 'my'])
    ->name('puisis.mypuisi')
    ->middleware('auth');
Route::resource('puisis', PuisiController::class);
Route::post('/puisis/{puisi}/komentars', [KomentarController::class, 'store'])->name('komentars.store');
Route::delete('/komentars/{komentar}', [KomentarController::class, 'destroy'])->name('komentars.destroy');

// Home
Route::get('/', function () {
    return redirect()->route('puisis.index');
});
