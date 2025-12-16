<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return response()->json([
        'message' => 'API KotaKita Surabaya is running!',
        'timestamp' => now(),
    ]);
});

// Public routes (akan diisi nanti di Sprint 1)
Route::prefix('auth')->group(function () {
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/login', [AuthController::class, 'login']);
    // dst...
});

// Protected routes (akan diisi nanti)
Route::middleware('auth:api')->group(function () {
    // User routes
    // Admin routes
});