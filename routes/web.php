<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Models\Kelurahan; 
use App\Models\Report;    
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-villages/{id}', function ($id) {
    return Kelurahan::where('kecamatan_id', $id)->get();
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard dengan Statistik
    Route::get('/dashboard', function () {
        $userId = Auth::id();
        
        // Hitung Data Laporan User
        $total    = Report::where('user_id', $userId)->count();
        $pending  = Report::where('user_id', $userId)->where('status', 'pending')->count();
        $process  = Report::where('user_id', $userId)->where('status', 'proses')->count();
        $completed= Report::where('user_id', $userId)->where('status', 'selesai')->count();

        // Kirim data ke view dashboard
        return view('dashboard', compact('total', 'pending', 'process', 'completed'));
    })->name('dashboard');

    // Fitur laporan
    Route::get('/laporan/buat', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/laporan/simpan', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/laporan/riwayat', [ReportController::class, 'index'])->name('reports.index');
});

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [AdminReportController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
});

require __DIR__.'/auth.php';