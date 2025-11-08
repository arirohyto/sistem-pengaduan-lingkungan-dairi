

<?php $__env->startSection('title', 'Manajemen Lokasi - SPPLH Dairi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main class="flex-1 flex-col p-8">
        <div class="w-full max-w-7xl mx-auto">
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
                                    class="w-[35%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Nama Lokasi</th>
                                <th
                                    class="w-[45%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Deskripsi</th>
                                <th
                                    class="w-[20%] px-4 py-3 text-left text-gray-800 dark:text-gray-300 text-sm font-medium">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                                $lokasis = [
                                    [
                                        'nama' => 'TPS Sidikalang',
                                        'deskripsi' => 'Tempat Pembuangan Sementara di pusat kota Sidikalang.',
                                    ],
                                    [
                                        'nama' => 'Sungai Lae Pendaroh',
                                        'deskripsi' => 'Area sungai yang sering dijadikan lokasi pembuangan ilegal.',
                                    ],
                                    [
                                        'nama' => 'Pasar Induk',
                                        'deskripsi' => 'Area pengelolaan sampah di sekitar Pasar Induk.',
                                    ],
                                ];
                            ?>

                            <?php $__currentLoopData = $lokasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="h-[72px] px-4 py-2 text-gray-900 dark:text-white text-sm font-normal">
                                        <?php echo e($lokasi['nama']); ?>

                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-gray-500 dark:text-gray-400 text-sm font-normal">
                                        <?php echo e($lokasi['deskripsi']); ?>

                                    </td>
                                    <td class="h-[72px] px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <button
                                                class="p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                                                data-action="edit-lokasi">
                                                <span class="material-symbols-outlined" style="font-size: 20px;">edit</span>
                                            </button>
                                            <button
                                                class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                                                data-action="hapus-lokasi">
                                                <span class="material-symbols-outlined"
                                                    style="font-size: 20px;">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>

    <!-- Modal Tambah Lokasi -->
    <div id="tambahLokasiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
            <h2 class="text-xl font-bold mb-4">Tambah Lokasi</h2>
            <hr class="mb-4">

            <!-- Form hanya untuk tampilan (tidak disubmit) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lokasi</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: TPS Sidikalang">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Deskripsi lokasi..."></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button id="btnBatal"
                    class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors">
                    Batal
                </button>
                <button id="btnSimpan"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('tambahLokasiModal');
                const btnOpen = document.getElementById('btnOpenModal');
                const btnBatal = document.getElementById('btnBatal');
                const btnSimpan = document.getElementById('btnSimpan');

                // Buka modal
                btnOpen?.addEventListener('click', () => {
                    modal.classList.remove('hidden');
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

                // Tombol Simpan hanya menutup (karena frontend-only)
                btnSimpan?.addEventListener('click', () => {
                    alert('Fitur simpan akan diaktifkan saat backend siap.');
                    closeModal();
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
    <!-- Modal Edit Lokasi -->
    <div id="editLokasiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
            <h2 class="text-xl font-bold mb-4">Edit Lokasi</h2>
            <hr class="mb-4">

            <!-- Form (dummy) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lokasi</label>
                <input type="text" id="namaLokasi"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: TPS Sidikalang">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsiLokasi" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Deskripsi lokasi..."></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button id="btnBatalEdit"
                    class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors">
                    Batal
                </button>
                <button id="btnSimpanEdit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('editLokasiModal');
                const btnBatal = document.getElementById('btnBatalEdit');
                const btnSimpan = document.getElementById('btnSimpanEdit');

                // Buka modal via tombol edit (delegasi event)
                document.addEventListener('click', function(e) {
                    if (e.target.closest('[data-action="edit-lokasi"]')) {
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

                // Simpan (dummy)
                btnSimpan?.addEventListener('click', () => {
                    const nama = document.getElementById('namaLokasi').value;
                    const deskripsi = document.getElementById('deskripsiLokasi').value;
                    alert(`Lokasi berhasil diperbarui:\n\nNama: ${nama}\nDeskripsi: ${deskripsi}`);
                    closeModal();
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
    <!-- Modal Konfirmasi Hapus -->
    <div id="hapusLokasiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="size-12 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-red-500">delete</span>
                </div>
                <button id="btnCloseHapus" class="text-gray-500 hover:text-gray-700">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <h2 class="text-xl font-bold mb-2">Hapus Lokasi</h2>
            <p class="text-gray-600 mb-6">Apakah anda yakin untuk menghapus lokasi ini?</p>

            <div class="flex justify-end gap-2">
                <button id="btnBatalHapus"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button id="btnKonfirmasiHapus"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('hapusLokasiModal');
                const btnBatal = document.getElementById('btnBatalHapus');
                const btnKonfirmasi = document.getElementById('btnKonfirmasiHapus');
                const btnClose = document.getElementById('btnCloseHapus');

                // Buka modal via tombol hapus (delegasi event)
                document.addEventListener('click', function(e) {
                    if (e.target.closest('[data-action="hapus-lokasi"]')) {
                        modal.classList.remove('hidden');
                    }
                });

                // Tutup modal
                function closeModal() {
                    modal.classList.add('hidden');
                }

                btnBatal?.addEventListener('click', closeModal);
                btnClose?.addEventListener('click', closeModal);
                modal?.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closeModal();
                });

                // Simpan (dummy)
                btnKonfirmasi?.addEventListener('click', () => {
                    alert('Lokasi berhasil dihapus!');
                    closeModal();
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/lokasi/index.blade.php ENDPATH**/ ?>