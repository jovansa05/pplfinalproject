<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalReports = Report::count();
        $pendingReports = Report::where('status', 'pending')->count();
        $processReports = Report::where('status', 'proses')->count();
        $completedReports = Report::where('status', 'selesai')->count();
        
        $recentReports = Report::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalReports',
            'pendingReports',
            'processReports',
            'completedReports',
            'recentReports'
        ));
    }
}
