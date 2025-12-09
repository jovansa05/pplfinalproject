<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // RUTE SEMENTARA UNTUK LAPORAN
    // Kita buat rute "dummy" dulu supaya dashboard tidak error

    // Tombol "Buat Laporan Baru"
    Route::get('/laporan/buat', function () {
        return "🚧 Halaman Buat Laporan (Akan dikerjakan di Sprint Laporan)";
    })->name('reports.create');

    // Tombol "Lihat Status Laporan"
    Route::get('/laporan/riwayat', function () {
        return "🚧 Halaman Riwayat Laporan (Akan dikerjakan di Sprint Laporan)";
    })->name('reports.index');
});

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
