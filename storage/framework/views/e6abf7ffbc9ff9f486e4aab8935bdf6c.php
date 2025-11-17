<?php $__env->startSection('title', 'Laporan Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto px-4 md:px-0 py-8">
        <div class="flex items-center justify-between gap-3 mb-6">
            <h1 class="text-gray-900 dark:text-white text-2xl sm:text-3xl md:text-4xl font-black tracking-tighter">
                Laporan Saya
            </h1>
        </div>

        
        <?php if(session('ok')): ?>
            <div
                class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 text-sm">
                <?php echo e(session('ok')); ?>

            </div>
        <?php endif; ?>

        <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/50">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 sm:px-6 sm:py-3 text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-200">
                            No
                        </th>
                        <th class="px-4 py-2 sm:px-6 sm:py-3 text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-200">
                            Lokasi
                        </th>
                        <th class="px-4 py-2 sm:px-6 sm:py-3 text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-200">
                            Tanggal
                        </th>
                        <th class="px-4 py-2 sm:px-6 sm:py-3 text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-200">
                            Status
                        </th>
                        <th class="px-4 py-2 sm:px-6 sm:py-3 text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-200">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <?php echo e($lap->code); ?>

                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <?php echo e($lap->location->name ?? 'Lokasi tidak tersedia'); ?>

                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <?php echo e($lap->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm">
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 text-[11px] sm:text-xs font-bold rounded-full <?php echo e($lap->status_badge['bg']); ?> <?php echo e($lap->status_badge['text']); ?>">
                                    <?php echo e($lap->status_label); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <a href="<?php echo e(route('laporan.show', $lap->code)); ?>"
                                    class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                    title="Lihat Detail">
                                    <span class="material-symbols-outlined text-base sm:text-lg">visibility</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5"
                                class="px-4 py-6 sm:px-6 sm:py-8 text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                Belum ada laporan.
                                <a href="<?php echo e(route('laporan.create')); ?>" class="text-primary hover:underline">
                                    Buat laporan pertama Anda
                                </a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/pages/laporansaya.blade.php ENDPATH**/ ?>