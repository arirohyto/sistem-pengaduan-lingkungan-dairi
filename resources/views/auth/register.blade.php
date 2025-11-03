@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
<div class="relative flex min-h-[70vh] w-full flex-col">
    <main class="flex justify-center px-4 py-10 sm:py-16 md:py-20">
        <div class="w-full max-w-lg space-y-8">
        <!-- Heading -->
        <div class="flex flex-col items-center mb-8">
            <p class="text-text-dark dark:text-text-light text-4xl font-black tracking-[-0.033em]">DAFTAR</p>
        </div>
        
        <!-- Form Container -->
        <div class="flex flex-col gap-6 p-6 sm:p-8 border border-primary/30 rounded-lg bg-white dark:bg-black/20 shadow-sm">
            <form class="flex flex-col gap-6" method="POST" action="#">
                @csrf
                
                <!-- Nama -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Nama</p>
                    <input 
                        type="text" 
                        placeholder="Masukkan nama lengkap Anda"
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                    />
                </label>
                
                <!-- Email -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Email</p>
                    <input 
                        type="email" 
                        placeholder="contoh@email.com"
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                    />
                </label>
                
                <!-- Password -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Kata Sandi</p>
                    <div class="relative">
                        <input 
                            type="password" 
                            placeholder="Buat kata sandi"
                            class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                        />
                    </div>
                </label>
                
                <!-- Konfirmasi Password -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Ulangi Kata Sandi</p>
                    <div class="relative">
                        <input 
                            type="password" 
                            placeholder="Konfirmasi kata sandi Anda"
                            class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                        />
                    </div>
                </label>
                
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Masuk</a>
                    </p>
                    <button 
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center h-11 px-6 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90">
                        DAFTAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection