<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class BerandaController extends Controller
{
    public function index()
    {
        $stats = [
            'total_laporan' => Laporan::count(),
            'pending' => Laporan::pending()->count(),
            'diproses' => Laporan::diproses()->count(),
            'selesai' => Laporan::selesai()->count(),
        ];

        return view('pages.beranda', compact('stats'));
    }
}