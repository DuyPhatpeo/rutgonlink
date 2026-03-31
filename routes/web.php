<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Auth Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Link API Routes
Route::post('/api/shorten', [LinkController::class, 'shorten']);
Route::middleware('auth')->group(function () {
    Route::get('/api/stats', [LinkController::class, 'stats']);
    Route::get('/api/logs', [LinkController::class, 'logs']);
    Route::delete('/api/delete/{id}', [LinkController::class, 'delete']);
});


// Redirect Route (Must be last)
Route::get('/{short_code}', [LinkController::class, 'redirect']);


