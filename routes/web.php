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

// Password Verification
Route::post('/links/{id}/verify', [LinkController::class, 'verifyPassword'])->name('links.verify');



// Link API Routes
Route::post('/api/shorten', [LinkController::class, 'shorten']);
Route::middleware('auth')->group(function () {
    Route::get('/api/stats', [LinkController::class, 'stats']);
    Route::get('/api/logs', [LinkController::class, 'logs']);
    Route::get('/api/chart', [LinkController::class, 'chart']);
    Route::delete('/api/delete/{id}', [LinkController::class, 'delete']);
    
    // New Management APIs
    Route::get('/api/links/{id}', [LinkController::class, 'detail']);
    Route::patch('/api/links/{id}', [LinkController::class, 'update']);
    Route::post('/api/links/{id}/reset', [LinkController::class, 'reset']);

    // Web Routes
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::get('/links/{id}', [LinkController::class, 'show'])->name('links.show');
});


// Redirect Route (Must be last)
Route::get('/{short_code}', [LinkController::class, 'redirect']);


