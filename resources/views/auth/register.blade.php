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
            
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="flex flex-col gap-6" method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Nama -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Nama</p>
                    <input 
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                    />
                </label>
                
                <!-- Email -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Email</p>
                    <input 
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                    />
                </label>
                
                <!-- No HP -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">No. HP</p>
                    <input 
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08123456789"
                        required
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base"
                    />
                </label>
                
                <!-- Password -->
                <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Kata Sandi</p>
                    <div class="relative">
                        <input 
                            type="password"
                            name="password"
                            placeholder="Buat kata sandi"
                            required
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
                            name="password_confirmation"
                            placeholder="Konfirmasi kata sandi Anda"
                            required
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