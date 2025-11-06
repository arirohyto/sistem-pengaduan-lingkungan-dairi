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

Route::get('/test', function () {
    return 'Test OK';
});
