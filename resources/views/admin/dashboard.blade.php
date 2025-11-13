@extends('layouts.admin')

@section('title', 'Admin Dashboard - Sistem Pengaduan Lingkungan')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
        <!-- Page Content Area -->
        <div class="p-6">
            <!-- Error/Success Messages -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-wrap justify-between gap-3 mb-6">
                <p class="text-zinc-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Dashboard Admin</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Laporan</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_laporan'] ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-300">description</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Menunggu</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-yellow-600">schedule</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Diproses</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $stats['diproses'] ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-blue-600">autorenew</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Selesai</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['selesai'] ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-green-600">check_circle</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total User</p>
                            <p class="text-2xl font-bold text-purple-600">{{ $stats['total_users'] ?? 0 }}</p>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-purple-600">people</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-background-light dark:bg-background-dark">
                            <tr>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Kode</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Judul</th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Pelapor
                                </th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Lokasi
                                </th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Tanggal
                                </th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Status
                                </th>
                                <th class="px-4 py-3 text-left text-zinc-900 dark:text-white text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                            @if ($recentReports->count() == 0)
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada laporan.
                                    </td>
                                </tr>
                            @else
                                @foreach ($recentReports as $report)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                        <td class="h-[72px] px-4 py-2 text-zinc-900 dark:text-white text-sm font-mono">
                                            {{ $report->code }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-900 dark:text-white text-sm">
                                            {{ $report->title }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report->reporter_name ?? 'Anonim' }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report->location->name ?? '-' }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            {{ $report->created_at->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <span
                                                class="inline-flex items-center justify-center rounded-full h-7 px-3 {{ $report->status_badge['bg'] }} {{ $report->status_badge['text'] }} text-xs font-medium">
                                                {{ $report->status_label }}
                                            </span>
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.laporan.show', $report->id) }}"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-base">visibility</span>
                                                </a>
                                                <button
                                                    onclick="openStatusModal({{ $report->id }}, '{{ $report->status }}')"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Status Update Modal -->
    <div id="updateStatusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
            <h2 class="text-xl font-bold mb-4">Update Status Laporan</h2>
            <hr class="mb-4">

            <form id="statusUpdateForm" method="POST" action="{{ route('admin.laporan.updateStatus') }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="report_id" id="reportIdInput">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" id="statusSelect"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-zinc-700 dark:text-white">
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-zinc-700 dark:text-white"
                        placeholder="Tambahkan catatan (opsional)"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors">
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
            function openStatusModal(reportId, currentStatus) {
                console.log('🔄 Attempting to open modal for report:', reportId, 'status:', currentStatus);

                setTimeout(function() {
                    try {
                        const reportInput = document.getElementById('reportIdInput');
                        const statusSelect = document.getElementById('statusSelect');
                        const modal = document.getElementById('updateStatusModal');

                        console.log('🔍 Elements found:');
                        console.log('- reportInput:', reportInput);
                        console.log('- statusSelect:', statusSelect);
                        console.log('- modal:', modal);

                        if (!reportInput) {
                            console.error('❌ Element reportIdInput not found');
                            alert('Error: Form input tidak ditemukan. Silakan refresh halaman.');
                            return;
                        }

                        if (!statusSelect) {
                            console.error('❌ Element statusSelect not found');
                            alert('Error: Status select tidak ditemukan. Silakan refresh halaman.');
                            return;
                        }

                        if (!modal) {
                            console.error('❌ Element updateStatusModal not found');
                            alert('Error: Modal tidak ditemukan. Silakan refresh halaman.');
                            return;
                        }

                        // Set values
                        reportInput.value = reportId;
                        statusSelect.value = currentStatus;

                        // Show modal
                        modal.classList.remove('hidden');

                        console.log('✅ Modal opened successfully');
                        console.log('📝 Report ID set to:', reportInput.value);
                        console.log('📝 Status set to:', statusSelect.value);

                    } catch (error) {
                        console.error('💥 Error in openStatusModal:', error);
                        alert('Terjadi kesalahan: ' + error.message);
                    }
                }, 100); // Wait 100ms
            }

            function closeStatusModal() {
                console.log('🔄 Attempting to close modal');

                try {
                    const modal = document.getElementById('updateStatusModal');
                    if (modal) {
                        modal.classList.add('hidden');
                        console.log('✅ Modal closed successfully');
                    } else {
                        console.error('❌ Modal not found when trying to close');
                    }
                } catch (error) {
                    console.error('💥 Error in closeStatusModal:', error);
                }
            }

            // DOM Ready
            document.addEventListener('DOMContentLoaded', function() {
                console.log('🚀 Dashboard JavaScript loaded');

                // Check if all required elements exist
                setTimeout(function() {
                    const modal = document.getElementById('updateStatusModal');
                    const reportInput = document.getElementById('reportIdInput');
                    const statusSelect = document.getElementById('statusSelect');

                    console.log('🔍 DOM Check:');
                    console.log('- Modal exists:', !!modal);
                    console.log('- Report input exists:', !!reportInput);
                    console.log('- Status select exists:', !!statusSelect);

                    if (!modal || !reportInput || !statusSelect) {
                        console.error('❌ Some required elements are missing!');
                        console.log('🔧 Please check if modal HTML is properly rendered');
                    } else {
                        console.log('✅ All required elements found');
                    }

                    // Count edit buttons
                    const editButtons = document.querySelectorAll('button[onclick*="openStatusModal"]');
                    console.log('🔘 Found edit buttons:', editButtons.length);

                    // Add backup event listeners
                    editButtons.forEach((button, index) => {
                        button.addEventListener('click', function(e) {
                            console.log(`🖱️ Edit button ${index} clicked via event listener`);
                        });
                    });

                }, 500); // Wait 500ms for full DOM render

                // Close modal when clicking outside
                document.addEventListener('click', function(e) {
                    const modal = document.getElementById('updateStatusModal');
                    if (modal && e.target === modal) {
                        closeStatusModal();
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeStatusModal();
                    }
                });
            });

            // Test function - call this in console to debug
            function testModal() {
                console.log('🧪 Testing modal elements...');
                openStatusModal(999, 'pending');
            }
        </script>
    @endpush
@endsection
