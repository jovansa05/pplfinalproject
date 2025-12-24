<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
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

        $path = $request->file('image')->store('reports', 'public');
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

        // Muat data kategori agar nama kategorinya muncul di view
        $report->load('category');

        return view('reports.show', compact('report'));
    }
}