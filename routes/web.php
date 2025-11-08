<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::view('/', 'pages.beranda')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('buatlaporan', 'pages.buatlaporan')->name('reports.create');
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/lokasi', function () {
    return view('admin.lokasi.index');
})->name('admin.lokasi.index');

Route::get('/admin/lokasi/create', function () {
    return view('admin.lokasi.index'); // atau arahkan ke index dulu
})->name('admin.lokasi.create');

// Simpan laporan ke file JSON (mock)
Route::post('/laporansaya', function (Request $request) {
    // Validasi input
    $validated = $request->validate([
        'jenis_laporan' => 'required|in:sampah,lingkungan',
        'lokasi' => 'required|string|max:120',
        'deskripsi' => 'required|string|min:10',
        'phone' => 'nullable|string|max:30',
        'email' => 'nullable|email',
    ]);

    $path = 'mock/reports.json';

    // Buat file jika belum ada
    if (!Storage::exists($path)) {
        Storage::put($path, '[]');
    }

    // Ambil data existing
    $allReports = json_decode(Storage::get($path), true) ?: [];

    // Generate nomor tiket: DLH-YYYYMMDD-XXXX
    $ticketNumber = 'DLH-' . now()->format('Ymd') . '-' . str_pad(count($allReports) + 1, 4, '0', STR_PAD_LEFT);

    // Tambah laporan baru
    $allReports[] = [
        'ticket' => $ticketNumber,
        'jenis' => $validated['jenis_laporan'],
        'kecamatan' => $validated['kecamatan'],
        'deskripsi' => $validated['deskripsi'],
        'phone' => $validated['phone'] ?? null,
        'email' => $validated['email'] ?? null,
        'status' => 'submitted',
        'created_at' => now()->toDateTimeString(),
    ];

    // Simpan ke file
    Storage::put($path, json_encode($allReports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return redirect()
        ->route('reports.mine')
        ->with('ok', "Laporan berhasil terkirim. Nomor Tiket: $ticketNumber");
})->name('reports.store');

// Daftar laporan (mock) → Laporan Saya
Route::get('/laporan', function () {
    $path = 'mock/reports.json';
    $allReports = Storage::exists($path) 
        ? json_decode(Storage::get($path), true) 
        : [];

    // Urutkan terbaru di atas
    $allReports = array_reverse($allReports);

    return view('pages.laporansaya', [
        'authMode' => true,
        'userName' => 'Ari Rohyto',
        'reports' => $allReports,
    ]);
})->name('reports.mine');

// Detail laporan (mock)
Route::get('/laporan/{ticket}', function (string $ticket) {
    $path = 'mock/reports.json';
    $allReports = Storage::exists($path) 
        ? json_decode(Storage::get($path), true) 
        : [];

    // Cari laporan berdasarkan ticket
    $report = collect($allReports)->firstWhere('ticket', $ticket);

    // Jika tidak ditemukan, tampilkan 404
    abort_if(!$report, 404);

    return view('pages.detaillaporan', [
        'authMode' => true,
        'userName' => 'Ari Rohyto',
        'ticket' => $ticket,
        'data' => $report,
    ]);
})->name('reports.show');