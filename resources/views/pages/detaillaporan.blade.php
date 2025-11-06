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
            <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tighter"> Detail Laporan
                {{ isset($ticket) ? "#$ticket" : '' }} </h1> <a href="{{ route('laporansaya') }}"
                class="rounded-lg h-10 px-4 bg-gray-100 dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                Kembali </a>
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
                        <td class="align-top w-1/3 px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Lokasi
                        </td>
                        <td class="w-2/3 px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $data['lokasi'] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Deskripsi</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $data['deskripsi'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Tanggal Laporan
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $data['tanggal'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Status</td>
                        <td class="px-6 py-4 text-sm"> @php
                            $s = strtolower($data['status'] ?? 'pending');
                            $map = ['pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Pending'], 'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'label' => 'Diproses'], 'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Selesai'], 'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Ditolak']];
                            $c = $map[$s] ?? $map['pending'];
                        @endphp <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $c['bg'] }} {{ $c['text'] }}">
                                {{ $c['label'] }} </span> </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div> @endsection
