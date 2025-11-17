

<?php $__env->startSection('title', 'Detail Laporan'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-0 py-6 sm:py-8">
        <div class="flex items-center justify-between gap-2 mb-6">
            <h1
                class="text-gray-900 dark:text-white text-2xl sm:text-3xl md:text-4xl font-black tracking-tighter leading-tight">
                Detail Laporan <?php echo e(isset($ticket) ? "#$ticket" : ''); ?>

            </h1>
            <a href="<?php echo e(route('laporan.index')); ?>"
                class="rounded-lg h-9 px-3 sm:h-10 sm:px-4 bg-gray-100 dark:bg-gray-800 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                Kembali
            </a>
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
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Kode Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->code); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Judul Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->title); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Jenis Laporan
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->jenis_laporan == 'sampah' ? 'Sampah' : 'Lingkungan Hidup'); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top w-1/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Lokasi
                        </td>
                        <td class="w-2/3 px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->location->name ?? '-'); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Deskripsi dan Alamat Lengkap
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->description); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Tanggal Laporan
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                            <?php echo e($laporan->created_at->translatedFormat('d F Y')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td
                            class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                            Status
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm">
                            <span
                                class="inline-flex items-center px-2.5 sm:px-3 py-1 text-[11px] sm:text-xs font-bold rounded-full <?php echo e($laporan->status_badge['bg']); ?> <?php echo e($laporan->status_badge['text']); ?>">
                                <?php echo e($laporan->status_label); ?>

                            </span>
                        </td>
                    </tr>

                    <?php
                        $lastHistory = $laporan->riwayatStatus->first();
                    ?>

                    <?php if($lastHistory && $lastHistory->note): ?>
                        <tr>
                            <td
                                class="align-top px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-100">
                                Catatan
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <div
                                    class="rounded-lg bg-gray-50 dark:bg-gray-800 p-3 sm:p-4 border border-gray-200 dark:border-gray-700 space-y-2">
                                    <p class="whitespace-pre-line leading-relaxed">
                                        <?php echo e($lastHistory->note); ?>

                                    </p>
                                    <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                        Diupdate oleh
                                        <span class="font-medium">
                                            <?php echo e($lastHistory->user->name ?? 'Admin'); ?>

                                        </span>
                                        pada
                                        <span>
                                            <?php echo e($lastHistory->created_at?->translatedFormat('d F Y, H:i')); ?>

                                        </span>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Foto Lampiran -->
                    <?php if($laporan->lampiran->count() > 0): ?>
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                                    <?php $__currentLoopData = $laporan->lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lampiran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="relative group">
                                            <img src="<?php echo e(asset('storage/' . $lampiran->file_path)); ?>" alt="Foto laporan"
                                                class="w-full h-24 sm:h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                                onclick="window.open('<?php echo e(asset('storage/' . $lampiran->file_path)); ?>', '_blank')">

                                            <!-- Download button -->
                                            <a href="<?php echo e(asset('storage/' . $lampiran->file_path)); ?>"
                                                download="<?php echo e($lampiran->file_name); ?>"
                                                class="absolute bottom-2 right-2 bg-black/50 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- Info foto -->
                                <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Klik foto untuk memperbesar, atau klik ikon download untuk mengunduh
                                </p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td class="align-top px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-100">Foto Bukti
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada foto bukti
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/pages/detaillaporan.blade.php ENDPATH**/ ?>