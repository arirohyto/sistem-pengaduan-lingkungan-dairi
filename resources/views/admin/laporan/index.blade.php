@extends('layouts.admin')

@section('title', 'Manajemen Laporan - Sistem Pengaduan Lingkungan')

@section('content')
    <div class="p-4 sm:p-6">
        {{-- Heading --}}
        <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
            <h1 class="text-zinc-900 dark:text-white text-2xl sm:text-3xl font-bold leading-tight">
                Manajemen Laporan
            </h1>
        </div>

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('admin.laporan.index') }}"
              class="mb-4 flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">
                    Status
                </label>
                <select name="status"
                        class="border border-gray-300 dark:border-zinc-600 rounded-md px-2 py-1.5 text-xs sm:text-sm dark:bg-zinc-800 dark:text-white">
                    <option value="">Semua</option>
                    <option value="pending"   {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses"  {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai"   {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak"   {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">
                    Jenis Laporan
                </label>
                <select name="jenis_laporan"
                        class="border border-gray-300 dark:border-zinc-600 rounded-md px-2 py-1.5 text-xs sm:text-sm dark:bg-zinc-800 dark:text-white">
                    <option value="">Semua</option>
                    <option value="sampah"     {{ request('jenis_laporan') === 'sampah' ? 'selected' : '' }}>Sampah</option>
                    <option value="lingkungan" {{ request('jenis_laporan') === 'lingkungan' ? 'selected' : '' }}>Lingkungan Hidup</option>
                </select>
            </div>

            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1">
                    Cari (kode / judul / deskripsi)
                </label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full border border-gray-300 dark:border-zinc-600 rounded-md px-3 py-1.5 text-xs sm:text-sm dark:bg-zinc-800 dark:text-white"
                       placeholder="Masukkan kata kunci">
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md text-xs sm:text-sm font-medium">
                    Terapkan
                </button>
                <a href="{{ route('admin.laporan.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md text-xs sm:text-sm font-medium">
                    Reset
                </a>
            </div>
        </form>

        {{-- Tabel Laporan --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-background-light dark:bg-background-dark">
                        <tr>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Kode</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Judul</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Pelapor</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Lokasi</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Jenis</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Tanggal</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Status</th>
                            <th class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium text-zinc-900 dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                        @forelse ($laporan as $report)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-900 dark:text-white font-mono">
                                    {{ $report->code }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $report->title }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $report->reporter_name ?? $report->reporter->name ?? 'Anonim' }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $report->location->name ?? '-' }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $report->jenis_laporan === 'sampah' ? 'Sampah' : 'Lingkungan Hidup' }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $report->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2">
                                    <span class="inline-flex items-center justify-center rounded-full h-6 px-2.5 text-[11px] sm:text-xs font-medium {{ $report->status_badge['bg'] }} {{ $report->status_badge['text'] }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 sm:px-4 sm:py-2">
                                    <a href="{{ route('admin.laporan.show', $report->id) }}"
                                       class="inline-flex items-center px-2 py-1 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-4 py-3">
                {{ $laporan->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection