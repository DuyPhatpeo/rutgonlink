<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Auth Routes (API)
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout']); // Backward compatibility



// Link API Routes
Route::post('/api/shorten', [LinkController::class, 'shorten']);
Route::middleware('auth')->group(function () {
    Route::get('/api/stats', [LinkController::class, 'stats']);
    Route::get('/api/logs', [LinkController::class, 'logs']);
    Route::get('/api/chart', [LinkController::class, 'chart']);
    Route::delete('/api/delete/{id}', [LinkController::class, 'delete']);
});


// Redirect Route (Must be last)
Route::get('/{short_code}', [LinkController::class, 'redirect']);


