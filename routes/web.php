<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    return 'Test OK';
});