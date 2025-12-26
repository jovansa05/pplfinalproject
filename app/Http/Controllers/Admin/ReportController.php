<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Category;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportStatusChanged;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['user.kecamatan', 'user.kelurahan', 'category']);

        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter Kecamatan (Wilayah)
        if ($request->filled('kecamatan')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('kecamatan_id', $request->kecamatan);
            });
        }
        
        // Filter Kelurahan (Wilayah)
        if ($request->filled('kelurahan')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('kelurahan_id', $request->kelurahan);
            });
        }
        
        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $reports = $query->latest()->paginate(10)->withQueryString();
        
        // Data untuk dropdown filter
        $categories = Category::active()->get();
        $kecamatans = Kecamatan::orderBy('name')->get();
        $kelurahans = $request->filled('kecamatan') 
            ? Kelurahan::where('kecamatan_id', $request->kecamatan)->orderBy('name')->get()
            : collect([]);

        return view('admin.reports.index', compact('reports', 'categories', 'kecamatans', 'kelurahans'));
    }

    public function show(Report $report)
    {
        $report->load(['user', 'category']);
        return view('admin.reports.show', compact('report'));
    }

    // --- BAGIAN PENTING YANG HARUS DIPERBAIKI ---
    public function updateStatus(Request $request, Report $report)
    {
        // 1. Validasi
        $rules = [
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ];

        // Validasi Wajib Isi Catatan/Foto kalau status tertentu
        if ($request->status == 'ditolak') {
            $rules['admin_note'] = 'required|string|min:5';
        }
        if ($request->status == 'selesai') {
            $rules['completion_proof'] = 'nullable|image|max:5120'; // Foto boleh kosong kalau update ulang, tapi sebaiknya diisi
            $rules['admin_note'] = 'required|string';
        }

        $request->validate($rules);

        $oldStatus = $report->status;

        // 2. Siapkan Data
        $dataToUpdate = [
            'status' => $request->status,
            'admin_note' => $request->admin_note, // INI PENTING: Simpan Catatan
        ];

        // 3. Proses Upload Foto (INI YANG KEMUNGKINAN HILANG DI KODINGANMU)
        if ($request->hasFile('completion_proof')) {
            $path = $request->file('completion_proof')->store('proofs', 'public');
            $dataToUpdate['completion_proof'] = $path;
        }

        // 4. Update Database
        $report->update($dataToUpdate);

        // 5. Kirim Email
        if ($oldStatus !== $request->status) {
            if ($report->user && $report->user->email) {
                Mail::to($report->user->email)->send(new ReportStatusChanged($report));
            }
        }

        return back()->with('success', 'Status update, catatan tersimpan, & foto terupload! 🚀');
    }
}