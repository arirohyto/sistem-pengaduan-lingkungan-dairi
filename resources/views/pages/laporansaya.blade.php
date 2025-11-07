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
                @forelse ($reports as $r)
                    @php
                        $date = \Carbon\Carbon::parse($r['created_at'])->translatedFormat('d F Y');
                        $statusMap = [
                            'submitted' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-800 dark:text-yellow-400', 'label' => 'Pending'],
                            'review' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-800 dark:text-blue-400', 'label' => 'Diproses'],
                            'in_progress' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-800 dark:text-blue-400', 'label' => 'Diproses'],
                            'resolved' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-800 dark:text-green-400', 'label' => 'Selesai'],
                            'rejected' => ['bg' => 'bg-red-100 dark:bg-red-900/30', 'text' => 'text-red-800 dark:text-red-400', 'label' => 'Ditolak'],
                        ];
                        $statusColor = $statusMap[$r['status']] ?? $statusMap['submitted'];
                    @endphp
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $r['kecamatan'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $date }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $statusColor['bg'] }} {{ $statusColor['text'] }}">
                                {{ $statusColor['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('reports.show', $r['ticket']) }}"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Lihat Detail">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada laporan. <a href="{{ route('reports.create') }}" class="text-primary hover:underline">Buat laporan pertama Anda</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection