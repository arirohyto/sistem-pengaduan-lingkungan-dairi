

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
                    Detail Laporan #<?php echo e($laporan->code); ?>

                </h1>
            </div>

            <!-- Form/Display Card -->
            <div class="bg-white dark:bg-black/20 p-8 rounded-xl shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kode Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Kode Laporan</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->code); ?>

                        </div>
                    </div>
                    
                    <!-- Judul Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Judul Laporan</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->title); ?>

                        </div>
                    </div>

                    <!-- Jenis Laporan -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Jenis Laporan</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->jenis_laporan == 'sampah' ? 'Sampah' : 'Lingkungan Hidup'); ?>

                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Lokasi Kejadian</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->location->name ?? '-'); ?>

                        </div>
                    </div>

                    <!-- Pelapor -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Pelapor</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->reporter_name ?? 'Anonim'); ?>

                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Tanggal Dilaporkan</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark h-14 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal items-center">
                            <?php echo e($laporan->created_at->translatedFormat('d F Y')); ?>

                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col md:col-span-2">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Deskripsi Laporan</p>
                        <div class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-background-light dark:bg-background-dark min-h-36 p-4 text-gray-700 dark:text-gray-300 text-base font-normal leading-normal">
                            <?php echo e($laporan->description); ?>

                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex flex-col">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Status</p>
                        <div class="flex items-center">
                            <span class="inline-flex items-center justify-center rounded-full px-4 py-1.5 text-sm font-semibold <?php echo e($laporan->status_badge['bg']); ?> <?php echo e($laporan->status_badge['text']); ?>">
                                <?php echo e($laporan->status_label); ?>

                            </span>
                        </div>
                    </div>

                    <!-- Foto Bukti -->
                    <?php if($laporan->lampiran->count() > 0): ?>
                    <div class="flex flex-col md:col-span-2">
                        <p class="text-gray-900 dark:text-white text-base font-medium leading-normal pb-2">Foto Bukti</p>
                        <div class="grid grid-cols-3 gap-4">
                            <?php $__currentLoopData = $laporan->lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lampiran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative group">
                                <img src="<?php echo e(asset('storage/' . $lampiran->file_path)); ?>" 
                                     alt="Foto laporan" 
                                     class="w-full h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                     onclick="window.open('<?php echo e(asset('storage/' . $lampiran->file_path)); ?>', '_blank')">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end mt-8">
                    <form method="POST" action="<?php echo e(route('admin.laporan.updateStatus')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="report_id" value="<?php echo e($laporan->id); ?>">
                        
                        <button type="button" data-modal-toggle="ubahStatusModal"
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal">
                            <span class="truncate">Update Status</span>
                        </button>
                    </form>
                </div>

                <!-- Modal Ubah Status -->
                <div id="ubahStatusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
                        <h2 class="text-xl font-bold mb-4">Ubah Status</h2>
                        <hr class="mb-4">

                        <form method="POST" action="<?php echo e(route('admin.laporan.updateStatus')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="report_id" value="<?php echo e($laporan->id); ?>">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="pending" <?php echo e($laporan->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="diproses" <?php echo e($laporan->status == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                                    <option value="ditolak" <?php echo e($laporan->status == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                                    <option value="selesai" <?php echo e($laporan->status == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Tambahkan catatan (opsional)"></textarea>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="button" id="btnBatalStatus" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition-colors mr-2">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php $__env->startPush('scripts'); ?>
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
                <?php $__env->stopPush(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/laporan/show.blade.php ENDPATH**/ ?>