<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\BioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Auth Routes (API)
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout']); // Backward compatibility

// Google Social Login Routes
Route::get('/auth/google', [\App\Http\Controllers\GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleAuthController::class, 'callback'])->name('google.callback');

// Password Verification
Route::post('/links/{link}/verify', [LinkController::class, 'verifyPassword'])->name('links.verify');



// Link API Routes
Route::post('/api/shorten', [LinkController::class, 'shorten']);
Route::middleware('auth')->group(function () {
    Route::get('/api/stats', [LinkController::class, 'stats']);
    Route::get('/api/logs', [LinkController::class, 'logs']);
    Route::get('/api/chart', [LinkController::class, 'chart']);
    Route::delete('/api/delete/{link}', [LinkController::class, 'delete']);
    
    // New Management APIs
    Route::get('/api/links/{link}', [LinkController::class, 'detail']);
    Route::patch('/api/links/{link}', [LinkController::class, 'update']);
    Route::patch('/api/links/{link}/toggle-status', [LinkController::class, 'toggleStatus']);
    Route::post('/api/links/{link}/reset', [LinkController::class, 'reset']);

    // Web Routes
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::get('/links/{link}', [LinkController::class, 'show'])->name('links.show');

    // Bio Page Routes
    Route::get('/bio', [BioController::class, 'index'])->name('bio.index');
    Route::get('/bio/create', [BioController::class, 'create'])->name('bio.create');
    Route::post('/api/bio', [BioController::class, 'store'])->name('bio.store');
    Route::get('/bio/{bioPage}/edit', [BioController::class, 'edit'])->name('bio.edit');
    Route::patch('/api/bio/{bioPage}', [BioController::class, 'update'])->name('bio.update');
    Route::delete('/api/bio/{bioPage}', [BioController::class, 'destroy'])->name('bio.destroy');
    Route::post('/api/bio/{bioPage}/links', [BioController::class, 'addLink'])->name('bio.links.add');
    Route::post('/api/bio/{bioPage}/reorder', [BioController::class, 'reorderLinks'])->name('bio.links.reorder');
    Route::patch('/api/bio/links/{link_id}', [BioController::class, 'updateLink'])->name('bio.links.update');
    Route::delete('/api/bio/links/{link_id}', [BioController::class, 'destroyLink'])->name('bio.links.destroy');
});


// Public Bio Page (Prefix /b/ to avoid conflict with short codes)
Route::get('/b/{slug}', [BioController::class, 'show'])->name('bio.show');


// Redirect Route (Must be last)
Route::get('/{short_code}', [LinkController::class, 'redirect']);


