@extends('layouts.admin')

@section('title', 'Tambah User - Sistem Pengaduan')

@section('content')
    <div class="p-4 sm:p-6 max-w-xl">
        <h1 class="text-zinc-900 dark:text-white text-2xl font-bold mb-4">Tambah User</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Role</label>
                <select name="role" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="masyarakat" {{ old('role') === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md text-sm">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md text-sm font-bold hover:bg-primary/90">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection