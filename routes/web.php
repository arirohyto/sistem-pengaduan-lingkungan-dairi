<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages.beranda');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/buatlaporan', function () {
    return view('pages.buatlaporan');
})->name('buatlaporan');

Route::get('/laporansaya', function () {
    return view('pages.laporansaya', [
        'authMode' => true, // aktifkan mode user di navbar
        'userName' => 'Ari Rohyto', // dummy dulu; nanti ganti dari Auth
    ]);
})->name('laporansaya');

Route::get('/laporan/{ticket}', function (string $ticket) {
    return view('pages.detaillaporan', [
        'authMode' => true,
        'userName' => 'Ari Rohyto',
        'ticket' => $ticket, // contoh: DLH-20240815-0001 atau 1
        'data' => [
            'lokasi' => 'Jl. Pahlawan No. 123, Sidikalang',
            'deskripsi' => 'Tumpukan sampah ilegal di pinggir jalan selama 2 minggu. Baunya mengganggu dan membuat banyak lalat.',
            'tanggal' => '15 Agustus 2024',
            'status' => 'pending', // pending|diproses|selesai|ditolak
        ],
    ]);
})->name('detaillaporan');

Route::get('/test', function () {
    return 'Test OK';
});
