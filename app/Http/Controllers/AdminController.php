<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User; // <--- JANGAN LUPA IMPORT MODEL USER
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportStatusChanged;

class AdminController extends Controller
{
    // 1. DASHBOARD ADMIN
    public function index()
    {
        // --- A. DATA STATISTIK (Ini yang bikin error tadi) ---
        // Kita hitung dulu jumlah-jumlahnya biar view nggak error
        $totalUsers       = User::count(); 
        $totalReports     = Report::count();
        $pendingReports   = Report::where('status', 'pending')->count();
        $processReports   = Report::where('status', 'proses')->count();
        $completedReports = Report::where('status', 'selesai')->count();

        // --- B. DATA TABEL LAPORAN ---
        $reports = Report::with('user', 'category')->latest()->get();
        
        // Kirim semua variabel ke view menggunakan compact
        return view('admin.dashboard', compact(
            'reports', 
            'totalUsers', 
            'totalReports', 
            'pendingReports', 
            'processReports', 
            'completedReports'
        ));
    }

    // 2. UPDATE STATUS
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ]);

        $oldStatus = $report->status;
        $newStatus = $request->status;

        $report->update([
            'status' => $newStatus
        ]);

        // Kirim Email jika status berubah
        if ($oldStatus !== $newStatus) {
            if ($report->user && $report->user->email) {
                Mail::to($report->user->email)->send(new ReportStatusChanged($report));
            }
        }

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui! 🚀');
    }
}