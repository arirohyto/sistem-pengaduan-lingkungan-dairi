@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 md:px-0 py-8">
    <div class="flex items-center justify-between gap-3 mb-6">
        <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tighter">Laporan Saya</h1>
        {{-- tombol cepat buat laporan --}}
        {{-- <a href="{{ route('reports.create') }}" class="h-10 px-4 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90">Buat Laporan</a> --}}
    </div>

    {{-- Alert Sukses --}}
    @if (session('ok'))
    <div class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 text-sm">
        {{ session('ok') }}
    </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/50">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200">No</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200">Lokasi</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200">Tanggal</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200">Status</th>
                    <th class="px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($laporan as $lap)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $lap->code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $lap->location->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $lap->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $lap->status_badge['bg'] }} {{ $lap->status_badge['text'] }}">
                                {{ $lap->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('laporan.show', $lap->code) }}"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Lihat Detail">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada laporan. <a href="{{ route('laporan.create') }}" class="text-primary hover:underline">Buat laporan pertama Anda</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection