<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportStatusChanged;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['user', 'category']);

        // Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $reports = $query->latest()->paginate(10)->withQueryString();
        // Kalau error "Method active not found", ganti jadi Category::all();
        $categories = Category::active()->get();

        return view('admin.reports.index', compact('reports', 'categories'));
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