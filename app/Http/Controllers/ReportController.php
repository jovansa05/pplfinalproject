<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use App\Models\Rating;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('category')->where('user_id', Auth::id())->latest()->get();
        
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'location'    => 'required',
            'description' => 'required',
            'image'       => 'required|image|max:5120',
        ]);

        // Compress and store image (quality 75%, max width 1920px)
        $path = ImageHelper::compressAndStore($request->file('image'), 'reports', 75, 1920);
        $ticket = 'TKT-' . date('dmy') . '-' . strtoupper(Str::random(3));

        Report::create([
            'ticket_number' => $ticket,
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'       => $path,       
            'location'    => $request->location, 
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'status'      => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan Berhasil Dikirim!');
    }

    public function show(Report $report)
    {
        // Keamanan: Pastikan user cuma bisa lihat laporannya sendiri
        // Kalau user A mencoba buka laporan user B, tolak aksesnya (403)
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Maaf, Anda tidak berhak melihat detail laporan ini.');
        }

        // Muat data kategori
        $report->load('category');
        
        // Load rating user untuk laporan ini
        $userRating = Rating::where('report_id', $report->id)
            ->where('user_id', Auth::id())
            ->first();

        return view('reports.show', compact('report', 'userRating'));
    }

    public function submitRating(Request $request, Report $report)
    {
        // Keamanan: Pastikan user cuma bisa rating laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Maaf, Anda tidak berhak memberikan rating pada laporan ini.');
        }

        // Pastikan laporan sudah selesai
        if ($report->status !== 'selesai') {
            return back()->with('error', 'Anda hanya dapat memberikan rating pada laporan yang sudah selesai.');
        }

        // Cek apakah user sudah memberikan rating sebelumnya
        $existingRating = Rating::where('report_id', $report->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            return back()->with('error', 'Anda sudah memberikan rating untuk laporan ini.');
        }

        // Validasi
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Simpan rating
        Rating::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih! Rating Anda telah tersimpan.');
    }
}