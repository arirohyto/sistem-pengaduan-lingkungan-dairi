@extends('layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    {{-- Leaflet CSS (jika masih ingin pakai peta interaktif) --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          crossorigin=""/>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .leaflet-container {
            font: 14px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
    </style>
@endpush

@section('content')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-0 py-6 sm:py-8">
        <div class="flex items-center justify-between gap-2 mb-6">
            <h1
                class="text-gray-900 dark:text-white text-2xl sm:text-3xl md:text-4xl font-black tracking-tighter leading-tight">
                Detail Laporan {{ isset($ticket) ? "#$ticket" : '' }}
            </h1>
            <a href="{{ route('laporan.index') }}"
                class="rounded-lg h-9 px-3 sm:h-10 sm:px-4 bg-gray-100 dark:bg-gray-800 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                Kembali
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/50">
            <table class="w-full text-left">
                <thead class="hidden">
                    <tr>
                        <th class="px-6 py-4">Properti</th>
                        <th class="px-6 py-4">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Kode Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->code }}
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Judul Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->title }}
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Jenis Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->jenis_laporan == 'sampah' ? 'Sampah' : 'Lingkungan Hidup' }}
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Lokasi
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->location->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Deskripsi dan Alamat Lengkap
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->description }}
                        </td>
                    </tr>

                    <!-- Peta Lokasi -->
                    <tr>
                        <td class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Lokasi Pelanggaran
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                            Peta lokasi pelanggaran ditampilkan di bawah.
                        </td>
                    </tr>

                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Tanggal Laporan
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->created_at->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Status
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm">
                            <span
                                class="inline-flex items-center px-2.5 sm:px-3 py-1 text-[11px] sm:text-xs font-bold rounded-full {{ $laporan->status_badge['bg'] }} {{ $laporan->status_badge['text'] }}">
                                {{ $laporan->status_label }}
                            </span>
                        </td>
                    </tr>

                    @php
                        $lastHistory = $laporan->riwayatStatus->first();
                    @endphp

                    @if ($lastHistory && $lastHistory->note)
                        <tr>
                            <td
                                class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                                Catatan
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <div
                                    class="rounded-lg bg-gray-50 dark:bg-gray-800 p-3 sm:p-4 border border-gray-200 dark:border-gray-700 space-y-2">
                                    <p class="whitespace-pre-line leading-relaxed">
                                        {{ $lastHistory->note }}
                                    </p>
                                    <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                        Diupdate oleh
                                        <span class="font-medium">
                                            {{ $lastHistory->user->name ?? 'Admin' }}
                                        </span>
                                        pada
                                        <span>
                                            {{ $lastHistory->created_at?->translatedFormat('d F Y, H:i') }}
                                        </span>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endif

                    <!-- Foto Lampiran -->
                    @if ($laporan->lampiran->count() > 0)
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                                    @foreach ($laporan->lampiran as $lampiran)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $lampiran->file_path) }}" alt="Foto laporan"
                                                class="w-full h-24 sm:h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                                onclick="window.open('{{ asset('storage/' . $lampiran->file_path) }}', '_blank')">

                                            <!-- Download button -->
                                            <a href="{{ asset('storage/' . $lampiran->file_path) }}"
                                                download="{{ $lampiran->file_name }}"
                                                class="absolute bottom-2 right-2 bg-black/50 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Info foto -->
                                <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Klik foto untuk memperbesar, atau klik ikon download untuk mengunduh
                                </p>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada foto bukti
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if ($laporan->latitude && $laporan->longitude)
            <div class="mt-4 bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl">
                <div class="px-4 sm:px-6 py-4 sm:py-5">
                    <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">
                        Lokasi Pelanggaran
                    </p>

                    @php
                        $lat = $laporan->latitude;
                        $lng = $laporan->longitude;
                        $apiKey = env('STADIA_MAPS_API_KEY', '77c0627e-19e5-4af5-9463-9965f56fb72e');
                        $staticMapUrl = "https://tiles.stadiamaps.com/staticmap?api_key={$apiKey}&center={$lat},{$lng}&zoom=16&size=600x300&style=alidade_smooth";
                        $osmUrl = "https://www.openstreetmap.org/?mlat={$lat}&mlon={$lng}#map=16/{$lat}/{$lng}";
                    @endphp

                    <a href="{{ $osmUrl }}" target="_blank" class="block rounded-lg overflow-hidden border border-border-light dark:border-border-dark">
                        <img src="{{ $staticMapUrl }}"
                             alt="Peta lokasi pelanggaran"
                             class="w-full h-40 sm:h-52 object-cover"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder-map.png') }}';">
                    </a>

                    <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-2">
                        Lokasi pelanggaran berdasarkan laporan pengguna. Klik peta untuk membuka di OpenStreetMap.
                    </p>
                </div>
            </div>
        @endif
    </div>
@endsection 