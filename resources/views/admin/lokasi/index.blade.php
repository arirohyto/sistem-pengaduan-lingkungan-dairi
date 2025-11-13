@extends('layouts.admin')

@section('title', 'Manajemen Lokasi - SPPLH Dairi')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 flex-col p-8">
        <div class="w-full max-w-7xl mx-auto">
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

            <!-- Heading & Button -->
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <p class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                    Manajemen Lokasi
                </p>
                <button id="btnOpenModal"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-green-700 transition-colors">
                    <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
                    <span class="truncate">Tambah Lokasi Baru</span>
                </button>
            </div>

            <!-- Table -->
            <div class="@container">
                <div
                    class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
                    <table class="flex-1">
                        <thead class="bg-gray-50 dark:bg-zinc-800">
                            <tr>
                                <th
                                    class="w-[40%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Nama Lokasi</th>
                                <th
                                    class="w-[40%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Deskripsi</th>
                                <th
                                    class="w-[10%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Status</th>
                                <th
                                    class="w-[10%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @if ($lokasis->count() == 0)
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada data lokasi. <br>
                                        <button onclick="document.getElementById('btnOpenModal').click()"
                                            class="text-primary hover:underline">
                                            Tambah lokasi pertama
                                        </button>
                                    </td>
                                </tr>
                            @else
                                @foreach ($lokasis as $lokasi)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                        <td class="h-[72px] px-4 py-2 text-gray-900 dark:text-white text-sm font-medium">
                                            {{ $lokasi->name }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2 text-gray-600 dark:text-gray-400 text-sm">
                                            {{ $lokasi->description ?? 'Kecamatan ' . $lokasi->name . ', Kabupaten Dairi' }}
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $lokasi->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $lokasi->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <button type="button"
                                                    class="edit-lokasi-btn p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                                                    data-id="{{ $lokasi->id }}" data-name="{{ $lokasi->name }}"
                                                    data-description="{{ $lokasi->description }}"
                                                    data-active="{{ $lokasi->is_active ? 'true' : 'false' }}"
                                                    title="Edit Lokasi">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </button>

                                                <form id="deleteForm-{{ $lokasi->id }}" method="POST"
                                                    action="{{ route('admin.lokasi.destroy', $lokasi->id) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="showDeleteModal({{ $lokasi->id }}, '{{ addslashes($lokasi->name) }}')"
                                                        class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                                                        title="Hapus Lokasi">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah/Edit Kecamatan -->
            <div id="lokasiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                    <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah Lokasi Baru</h2>
                    <hr class="mb-4">

                    <form id="lokasiForm" method="POST" action="{{ route('admin.lokasi.store') }}">
                        @csrf
                        <div id="methodField"></div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lokasi</label>
                            <input type="text" name="name" id="lokasiName" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-zinc-700 dark:text-white"
                                placeholder="Contoh: Sidikalang">
                        </div>

                        <input type="hidden" name="area_id" value="1"> <!-- Default ke Kabupaten Dairi -->

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                            <textarea name="description" id="lokasiDescription" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-zinc-700 dark:text-white"
                                placeholder="Deskripsi kecamatan (opsional)"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="lokasiActive" value="1" checked
                                    class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Kecamatan Aktif</span>
                            </label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeLokasiModal()"
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

            <!-- Modal Konfirmasi Hapus -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="bg-red-100 dark:bg-red-900 p-3 rounded-full mr-3">
                                <span
                                    class="material-symbols-outlined text-red-600 dark:text-red-300 text-2xl">delete</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Hapus Lokasi</h2>
                        </div>
                        <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-600 dark:text-gray-300">
                            Apakah anda yakin untuk menghapus lokasi ini?
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            <strong id="deleteLocationName"></strong> akan dihapus secara permanen.
                        </p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                            Batal
                        </button>
                        <button type="button" onclick="confirmDelete()"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let deleteLocationId = null;

        // Modal functions
        function openLokasiModal() {
            console.log('Opening new lokasi modal');
            resetForm();
            document.getElementById('lokasiModal').classList.remove('hidden');
        }

        function closeLokasiModal() {
            console.log('Closing lokasi modal');
            document.getElementById('lokasiModal').classList.add('hidden');
            resetForm();
        }

        function resetForm() {
            document.getElementById('lokasiForm').reset();
            document.getElementById('modalTitle').textContent = 'Tambah Lokasi Baru';
            document.getElementById('lokasiForm').action = '{{ route('admin.lokasi.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('lokasiActive').checked = true;
        }

        function editLokasi(id, name, description, isActive) {
            console.log('Editing lokasi:', id, name, description, isActive);

            document.getElementById('modalTitle').textContent = 'Edit Lokasi';

            document.getElementById('lokasiForm').action = '{{ route('admin.lokasi.update', ':id') }}'.replace(':id', id);
            document.getElementById('methodField').innerHTML = '@method('PUT')';

            document.getElementById('lokasiName').value = name;
            document.getElementById('lokasiDescription').value = description || '';
            document.getElementById('lokasiActive').checked = isActive === 'true';

            document.getElementById('lokasiModal').classList.remove('hidden');

            console.log('Edit modal opened with data:', name, description, isActive);
        }

        // Modal Delete
        function showDeleteModal(id, name) {
            console.log('🗑️ Showing delete modal for:', id, name);

            deleteLocationId = id;
            document.getElementById('deleteLocationName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            console.log('🔄 Closing delete modal');

            deleteLocationId = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function confirmDelete() {
            console.log('🗑️ Confirming delete for ID:', deleteLocationId);

            if (deleteLocationId) {
                // Submit form untuk hapus
                document.getElementById('deleteForm-' + deleteLocationId).submit();
            }
        }

        // DOM Ready Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Lokasi management JavaScript loaded');

            // Event listener untuk tombol tambah
            const btnOpenModal = document.getElementById('btnOpenModal');
            if (btnOpenModal) {
                btnOpenModal.addEventListener('click', openLokasiModal);
            }

            // Event listener untuk tombol edit (Event Delegation)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-lokasi-btn')) {
                    const button = e.target.closest('.edit-lokasi-btn');
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const description = button.getAttribute('data-description');
                    const isActive = button.getAttribute('data-active');

                    console.log('🖱️ Edit button clicked:', id, name);
                    editLokasi(id, name, description, isActive);
                }
            });

            // Close modals when clicking outside
            document.addEventListener('click', function(e) {
                // Close edit modal
                const editModal = document.getElementById('lokasiModal');
                if (editModal && e.target === editModal) {
                    closeLokasiModal();
                }

                // Close delete modal
                const deleteModal = document.getElementById('deleteModal');
                if (deleteModal && e.target === deleteModal) {
                    closeDeleteModal();
                }
            });

            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeLokasiModal();
                    closeDeleteModal();
                }
            });

            // Debug: Count buttons
            setTimeout(function() {
                const editButtons = document.querySelectorAll('.edit-lokasi-btn');
                const deleteButtons = document.querySelectorAll('button[onclick*="showDeleteModal"]');
                console.log('🔘 Found edit buttons:', editButtons.length);
                console.log('🗑️ Found delete buttons:', deleteButtons.length);
            }, 500);
        });
    </script>
@endsection
