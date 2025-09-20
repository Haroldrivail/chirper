<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::controller(ChirpController::class)->group(function () {
        Route::post('/chirps', 'store');
        Route::get('/chirps/{chirp}/edit', 'edit');
        Route::put('/chirps/{chirp}', 'update');
        Route::delete('/chirps/{chirp}', 'destroy');
    });
});

// Route::resource('/chirps', ChirpController::class)
//     ->only(['index, store, edit, update, delete']);

// Registration routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');
