@extends('layouts.admin')

@section('title', 'Detail Laporan - Sistem Pengaduan')

@push('styles')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
@endpush

<!-- Page Content -->
@section('content')
    <div class="flex-1 px-4 py-6 sm:px-6 sm:py-8 md:p-8">
        <div class="layout-content-container flex flex-col max-w-4xl mx-auto flex-1 gap-6 sm:gap-8">
            <!-- PageHeading -->
            <div class="flex flex-wrap justify-between items-center gap-2">
                <h1
                    class="text-gray-900 dark:text-white text-2xl sm:text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Detail Laporan #{{ $laporan->code }}
                </h1>
            </div>

            <!-- Form/Display Card -->
            <div class="bg-white dark:bg-black/20 p-8 rounded-xl shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kode Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Kode Laporan</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                    bg-background-light dark:bg-background-dark
                                    min-h-10 sm:h-12 md:h-14
                                    px-3 sm:px-4 py-2
                                    text-sm sm:text-base font-normal leading-normal text-gray-700 dark:text-gray-300 items-center">
                            {{ $laporan->code }}
                        </div>
                    </div>

                    <!-- Judul Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Judul Laporan</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                    bg-background-light dark:bg-background-dark
                                    min-h-10 sm:h-12 md:h-14
                                    px-3 sm:px-4 py-2
                                    text-sm sm:text-base font-normal leading-normal text-gray-700 dark:text-gray-300 items-center">
                            {{ $laporan->title }}
                        </div>
                    </div>

                    <!-- Jenis Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Jenis Laporan</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                    bg-background-light dark:bg-background-dark
                                    min-h-10 sm:h-12 md:h-14
                                    px-3 sm:px-4 py-2
                                    text-sm sm:text-base font-normal leading-normal text-gray-700 dark:text-gray-300 items-center">
                            {{ $laporan->jenis_laporan == 'sampah' ? 'Sampah' : 'Lingkungan Hidup' }}
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Lokasi Kejadian
                        </p>
                        <div
                            class="flex w-full min-w-0 flex-1 flex-col
                                rounded-lg bg-background-light dark:bg-background-dark
                                min-h-10 sm:h-auto px-3 sm:px-4 py-2 gap-2">
                            {{-- Nama lokasi --}}
                            <span class="text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                {{ $laporan->location->name ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <!-- Pelapor -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Pelapor</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                    bg-background-light dark:bg-background-dark
                                    min-h-10 sm:h-12 md:h-14
                                    px-3 sm:px-4 py-2
                                    text-sm sm:text-base font-normal leading-normal text-gray-700 dark:text-gray-300 items-center">
                            {{ $laporan->reporter_name ?? 'Anonim' }}
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">Tanggal
                            Dilaporkan</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                    bg-background-light dark:bg-background-dark
                                    min-h-10 sm:h-12 md:h-14
                                    px-3 sm:px-4 py-2
                                    text-sm sm:text-base font-normal leading-normal text-gray-700 dark:text-gray-300 items-center">
                            {{ $laporan->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col md:col-span-2">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Deskripsi Laporan
                        </p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark min-h-36 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal">
                            {{ $laporan->description }}
                        </div>
                    </div>

                    {{-- Lokasi Pelanggaran --}}
                    @if ($laporan->latitude && $laporan->longitude)
                        <div class="flex flex-col md:col-span-2">
                            <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">
                                Lokasi Pelanggaran
                            </p>

                            @php
                                $lat = $laporan->latitude;
                                $lng = $laporan->longitude;
                                $apiKey = env('STADIA_MAPS_API_KEY', '77c0627e-19e5-4af5-9463-9965f56fb72e');
                                $staticMapUrl = "https://tiles.stadiamaps.com/staticmap?api_key={$apiKey}&center={$lat},{$lng}&zoom=16&size=600x300&style=alidade_smooth";
                                $osmUrl = "https://www.openstreetmap.org/?mlat={$lat}&mlon={$lng}#map=16/{$lat}/{$lng}";
                            @endphp

                            <a href="{{ $osmUrl }}" target="_blank"
                                class="block max-w-md sm:max-w-lg mx-auto rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <img src="{{ $staticMapUrl }}"
                                        alt="Peta lokasi pelanggaran"
                                        class="w-full h-40 sm:h-52 object-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder-map.png') }}';">
                            </a>

                            <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-2">
                                Lokasi pelanggaran berdasarkan laporan pengguna. Klik peta untuk membuka di OpenStreetMap.
                            </p>
                        </div>
                    @endif

                    <!-- Status -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">
                            Status
                        </p>
                        <div class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center rounded-full
                                    px-3 py-1 text-[11px] sm:text-xs font-semibold
                                    {{ $laporan->status_badge['bg'] }} {{ $laporan->status_badge['text'] }}">
                                {{ $laporan->status_label }}
                            </span>
                        </div>
                    </div>

                    @php
                        $lastHistory = $laporan->riwayatStatus->first();
                    @endphp

                    @if ($lastHistory)
                        <div class="flex flex-col md:col-span-2">
                            <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">
                                Riwayat Status Terakhir
                            </p>

                            <div
                                class="flex w-full min-w-0 flex-1 flex-col gap-2 rounded-lg
                                        bg-background-light dark:bg-background-dark
                                        p-3 sm:p-4
                                        text-xs sm:text-sm leading-normal text-gray-700 dark:text-gray-300
                                        border border-gray-200 dark:border-gray-700">

                                {{-- Baris status dari -> ke --}}
                                <p>
                                    <span class="font-semibold">Dari:</span>
                                    {{ $lastHistory->from_status_label ?? '-' }}
                                    <span class="mx-1">→</span>
                                    <span class="font-semibold">Ke:</span>
                                    {{ $lastHistory->to_status_label }}
                                </p>

                                {{-- Catatan jika ada --}}
                                @if ($lastHistory->note)
                                    <p class="whitespace-pre-line">
                                        <span class="font-semibold">Catatan:</span><br>
                                        {{ $lastHistory->note }}
                                    </p>
                                @endif

                                {{-- Info siapa & kapan --}}
                                <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                    Diupdate oleh
                                    <span class="font-semibold">
                                        {{ $lastHistory->user->name ?? 'Admin' }}
                                    </span>
                                    pada
                                    <span>
                                        {{ $lastHistory->created_at?->translatedFormat('d F Y, H:i') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Foto Bukti -->
                    @if ($laporan->lampiran->count() > 0)
                        <div class="flex flex-col md:col-span-2">
                            <p class="text-gray-900 dark:text-white text-sm sm:text-base font-medium leading-normal pb-2">
                                Foto Bukti
                            </p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                                @foreach ($laporan->lampiran as $lampiran)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $lampiran->file_path) }}" alt="Foto laporan"
                                            class="w-full h-24 sm:h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                            onclick="window.open('{{ asset('storage/' . $lampiran->file_path) }}', '_blank')">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Button -->
                <div class="flex justify-end mt-6">
                    <form method="POST" action="{{ route('admin.laporan.updateStatus') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="report_id" value="{{ $laporan->id }}">

                        <button type="button" data-modal-toggle="ubahStatusModal"
                            class="flex min-w-[130px] sm:min-w-[160px] items-center justify-center
                                rounded-lg h-10 sm:h-12 px-4 sm:px-6
                                bg-primary text-white text-sm sm:text-base font-bold leading-normal">
                            <span class="truncate">Update Status</span>
                        </button>
                    </form>
                </div>

                <!-- Modal Ubah Status -->
                <div id="ubahStatusModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                        <h2 class="text-xl font-bold mb-4">Ubah Status</h2>
                        <hr class="mb-4">

                        <form method="POST" action="{{ route('admin.laporan.updateStatus') }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="report_id" value="{{ $laporan->id }}">

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Status</label>
                                <select name="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses</option>
                                    <option value="ditolak" {{ $laporan->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                <textarea name="notes" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Tambahkan catatan (opsional)"></textarea>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="button" id="btnBatalStatus"
                                    class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors mr-2">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = document.getElementById('ubahStatusModal');
                            const btnOpen = document.querySelector('[data-modal-toggle="ubahStatusModal"]');
                            const btnBatal = document.getElementById('btnBatalStatus');

                            // Buka modal
                            if (btnOpen) {
                                btnOpen.addEventListener('click', () => {
                                    modal.classList.remove('hidden');
                                });
                            }

                            // Tutup modal
                            function closeModal() {
                                modal.classList.add('hidden');
                            }

                            btnBatal?.addEventListener('click', closeModal);
                            modal?.addEventListener('click', (e) => {
                                if (e.target === modal) closeModal();
                            });
                            document.addEventListener('keydown', (e) => {
                                if (e.key === 'Escape') closeModal();
                            });
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
@endsection
