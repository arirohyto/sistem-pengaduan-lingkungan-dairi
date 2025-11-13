@extends('layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
@endpush

@section('content')

    <div class="max-w-4xl mx-auto px-4 md:px-0 py-8">
        <div class="flex items-center justify-between gap-3 mb-6">
            <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tighter">
                Detail Laporan {{ isset($ticket) ? "#$ticket" : '' }}
            </h1>
            <a href="{{ route('laporan.index') }}"
                class="rounded-lg h-10 px-4 bg-gray-100 dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
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
                        <td class="align-top w-1/3 px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Kode
                            Laporan
                        </td>
                        <td class="w-2/3 px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $laporan->code }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top w-1/3 px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Judul
                            Laporan
                        </td>
                        <td class="w-2/3 px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $laporan->title }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top w-1/3 px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Jenis
                            Laporan
                        </td>
                        <td class="w-2/3 px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->jenis_laporan == 'sampah' ? 'Sampah' : 'Lingkungan Hidup' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top w-1/3 px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Lokasi
                        </td>
                        <td class="w-2/3 px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->location->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Deskripsi dan Alamat Lengkap</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $laporan->description }}</td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Tanggal Laporan
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $laporan->created_at->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Status</td>
                        <td class="px-6 py-4 text-sm">
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $laporan->status_badge['bg'] }} {{ $laporan->status_badge['text'] }}">
                                {{ $laporan->status_label }}
                            </span>
                        </td>
                    </tr>

                    <!-- Foto Lampiran -->
                    @if ($laporan->lampiran->count() > 0)
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($laporan->lampiran as $lampiran)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $lampiran->file_path) }}" alt="Foto laporan"
                                                class="w-full h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
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
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Klik foto untuk memperbesar, atau klik ikon download untuk mengunduh
                                </p>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada foto bukti
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
</div> @endsection
