@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
    <div class="max-w-4xl mx-auto px-4 md:px-0 py-8">
        <div class="flex items-center justify-between gap-3 mb-6">
            <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tighter">Laporan Saya</h1>
            {{-- (opsional) tombol cepat buat laporan --}} {{-- <a href="{{ route('reports.create') }}" class="h-10 px-4 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90">Buat Laporan</a> --}}
        </div>
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
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">1</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Jl. Pahlawan No. 123, Sidikalang</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">15 Agustus 2024</td>
                        <td class="px-6 py-4 text-sm"> <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                        </td>
                        <td class="px-6 py-4"> <a href="#"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Detail"> <span class="material-symbols-outlined">visibility</span> </a> </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">2</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Pasar Induk Sidikalang</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">12 Agustus 2024</td>
                        <td class="px-6 py-4 text-sm"> <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold text-blue-800 bg-blue-100 rounded-full">Diproses</span>
                        </td>
                        <td class="px-6 py-4"> <a href="#"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Detail"> <span class="material-symbols-outlined">visibility</span> </a> </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">3</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Sungai Lae Pandaroh</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">10 Agustus 2024</td>
                        <td class="px-6 py-4 text-sm"> <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">Selesai</span>
                        </td>
                        <td class="px-6 py-4"> <a href="#"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Detail"> <span class="material-symbols-outlined">visibility</span> </a> </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">4</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Depan Kantor Kecamatan</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">05 Agustus 2024</td>
                        <td class="px-6 py-4 text-sm"> <span
                                class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                        </td>
                        <td class="px-6 py-4"> <a href="#"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Detail"> <span class="material-symbols-outlined">visibility</span> </a> </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div> @endsection
