

<?php $__env->startSection('title', 'Detail Laporan - Sistem Pengaduan'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
<?php $__env->stopPush(); ?>

<!-- Page Content -->
<?php $__env->startSection('content'); ?>
    <div class="flex-1 p-8">
        <div class="layout-content-container flex flex-col max-w-4xl mx-auto flex-1 gap-8">
            <!-- PageHeading -->
            <div class="flex flex-wrap justify-between gap-3">
                <h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                    Detail Laporan #<?php echo e($id ?? '12345'); ?>

                </h1>
            </div>

            <!-- Form/Display Card -->
            <div class="bg-white dark:bg-black/20 p-8 rounded-xl shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Lokasi -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Lokasi Kejadian
                        </p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            Jl. Sudirman No. 1, Sidikalang
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Tanggal
                            Dilaporkan</p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            24 Oktober 2025
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col md:col-span-2">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Deskripsi Laporan
                        </p>
                        <div
                            class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark min-h-36 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal">
                            Terdapat tumpukan sampah liar di pinggir jalan yang tidak diangkut selama lebih dari 2 minggu.
                            Baunya sangat mengganggu dan menimbulkan potensi penyakit bagi warga sekitar.
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Status
                        </p>
                        <div class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 px-4 py-1.5 text-sm font-semibold text-yellow-800 dark:text-yellow-200">
                                Diproses
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end mt-8">
                    <button data-modal-toggle="ubahStatusModal"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal">
                        <span class="truncate">Update Status</span>
                    </button>
                </div>
                <!-- Modal Ubah Status -->
                <div id="ubahStatusModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                        <h2 class="text-xl font-bold mb-4">Ubah Status</h2>
                        <hr class="mb-4">

                        <!-- Form (dummy) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Status</label>
                            <select id="statusSelect"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="pending">Pending</option>
                                <option value="diproses">Diproses</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button id="btnBatalStatus"
                                class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors mr-2">
                                Batal
                            </button>
                            <button id="btnSimpanStatus"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

                <?php $__env->startPush('scripts'); ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = document.getElementById('ubahStatusModal');
                            const btnOpen = document.querySelector('[data-modal-toggle="ubahStatusModal"]');
                            const btnBatal = document.getElementById('btnBatalStatus');
                            const btnSimpan = document.getElementById('btnSimpanStatus');

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

                            // Tombol Simpan hanya menutup modal (frontend-only)
                            btnSimpan?.addEventListener('click', () => {
                                alert('Status berhasil diubah!');
                                closeModal();
                            });
                        });
                    </script>
                <?php $__env->stopPush(); ?>
            </div>
        </div>
    </div>
    </main>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/laporan/show.blade.php ENDPATH**/ ?>