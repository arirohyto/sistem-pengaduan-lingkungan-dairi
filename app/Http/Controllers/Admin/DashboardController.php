<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_laporan' => Laporan::count(),
            'pending' => Laporan::where('status', 'pending')->count(),  
            'diproses' => Laporan::where('status', 'diproses')->count(), 
            'selesai' => Laporan::where('status', 'selesai')->count(),   
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
            'total_users' => User::where('role', 'masyarakat')->count(), 
        ];

        // Recent reports
        $recentReports = Laporan::with(['location', 'reporter'])
            ->latest()
            ->limit(10)
            ->get();

        // Reports by status (for chart)
        $reportsByStatus = Laporan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Reports by jenis_laporan (for chart)
        $reportsByJenis = Laporan::select('jenis_laporan', DB::raw('count(*) as total'))
            ->groupBy('jenis_laporan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentReports',
            'reportsByStatus',
            'reportsByJenis'
        ));
    }
}