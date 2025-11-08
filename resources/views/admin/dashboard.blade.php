@extends('layouts.admin')

@section('title', 'Admin Dashboard - Sistem Pengaduan Lingkungan')

@section('content')
    @php
        $reports = [
            [
                'judul' => 'Sampah Ilegal di Tepi Jalan',
                'pelapor' => 'Ari',
                'lokasi' => 'Jl. Ahmad Yani No. 10, Sidikalang',
                'tanggal' => '15 Okt 2025',
                'status' => 'Selesai',
            ],
            [
                'judul' => 'Pembakaran Sampah Malam Hari',
                'pelapor' => 'Rohyto',
                'lokasi' => 'Jl. Merdeka No. 5, Sidikalang',
                'tanggal' => '14 Okt 2025',
                'status' => 'Diproses',
            ],
            [
                'judul' => 'Limbah Pabrik ke Sungai',
                'pelapor' => 'Ibrena',
                'lokasi' => 'Sungai Lae Renun',
                'tanggal' => '13 Okt 2025',
                'status' => 'Menunggu',
            ],
            [
                'judul' => 'Penebangan Pohon Liar',
                'pelapor' => 'Padang',
                'lokasi' => 'Hutan Lindung Lae Pondom',
                'tanggal' => '11 Okt 2025',
                'status' => 'Ditolak',
            ],
        ];
    @endphp

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">

        <!-- Page Content Area -->
        <div class="p-6">
            <div class="flex flex-wrap justify-between gap-3 mb-6">
                <p class="text-zinc-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Dashboard Admin</p>
            </div>

            <!-- Table -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-background-light dark:bg-background-dark">
                            <tr>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Judul</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Pelapor</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Lokasi</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Tanggal</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Status</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                            @if (empty($reports))
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada laporan.</td>
                                </tr>
                            @else
                                @foreach ($reports as $report)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                        <td class="h-[72px] px-4 py-2 text-zinc-900 dark:text-white text-sm">
                                            {{ $report['judul'] }}</td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report['pelapor'] ?? 'Anonim' }}</td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report['lokasi'] }}</td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report['tanggal'] }}</td>
                                        <td class="h-[72px] px-4 py-2">
                                            @php
                                                $statusClass = match ($report['status']) {
                                                    'Selesai' => 'bg-primary/20 text-primary',
                                                    'Diproses'
                                                        => 'bg-status-yellow/20 text-yellow-800 dark:text-yellow-300',
                                                    'Ditolak' => 'bg-status-red/20 text-red-700 dark:text-red-300',
                                                    default
                                                        => 'bg-gray-200 dark:bg-zinc-700 text-gray-800 dark:text-gray-300',
                                                };
                                            @endphp
                                            <span
                                                class="inline-flex items-center justify-center rounded-full h-7 px-3 {{ $statusClass }} text-xs font-medium">
                                                {{ $report['status'] }}
                                            </span>
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <a href="#"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700" data-action="edit">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                <a href="{{ route('admin.laporan.show', ['id' => 1]) }}"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-base">history</span>
                                                </a>
                                            </div>
                                        </td>
                                        <!-- Modal Update Status -->
                                        <div id="updateStatusModal"
                                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                            <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                                                <h2 class="text-xl font-bold mb-4">Update Status Laporan</h2>
                                                <hr class="mb-4">

                                                <div class="mb-4">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                    <select id="statusSelect"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                                        <option value="menunggu">Pending</option>
                                                        <option value="diproses">Diproses</option>
                                                        <option value="ditolak">Ditolak</option>
                                                        <option value="selesai">Selesai</option>
                                                    </select>
                                                </div>

                                                <div class="flex justify-end gap-2">
                                                    <button id="btnBatalStatus"
                                                        class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors">
                                                        Batal
                                                    </button>
                                                    <button id="btnSimpanStatus"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        @push('scripts')
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const modal = document.getElementById('updateStatusModal');
                                                    const btnBatal = document.getElementById('btnBatalStatus');
                                                    const btnSimpan = document.getElementById('btnSimpanStatus');

                                                    // Buka modal via tombol edit (delegasi event)
                                                    document.addEventListener('click', function(e) {
                                                        if (e.target.closest('[data-action="edit"]')) {
                                                            modal.classList.remove('hidden');
                                                        }
                                                    });

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

                                                    // Simpan status (dummy)
                                                    btnSimpan?.addEventListener('click', () => {
                                                        const status = document.getElementById('statusSelect').value;
                                                        alert(`Status berhasil diubah menjadi: ${status}`);
                                                        closeModal();
                                                    });
                                                });
                                            </script>
                                        @endpush
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
@endsection
