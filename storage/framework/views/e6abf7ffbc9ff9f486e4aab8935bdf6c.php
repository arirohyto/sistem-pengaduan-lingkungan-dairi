

<?php $__env->startSection('title', 'Laporan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 md:px-0 py-8">
    <div class="flex items-center justify-between gap-3 mb-6">
        <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tighter">Laporan Saya</h1>
        
        
    </div>

    
    <?php if(session('ok')): ?>
    <div class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 text-sm">
        <?php echo e(session('ok')); ?>

    </div>
    <?php endif; ?>

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
                <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $date = \Carbon\Carbon::parse($r['created_at'])->translatedFormat('d F Y');
                        $statusMap = [
                            'submitted' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-800 dark:text-yellow-400', 'label' => 'Pending'],
                            'review' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-800 dark:text-blue-400', 'label' => 'Diproses'],
                            'in_progress' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-800 dark:text-blue-400', 'label' => 'Diproses'],
                            'resolved' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-800 dark:text-green-400', 'label' => 'Selesai'],
                            'rejected' => ['bg' => 'bg-red-100 dark:bg-red-900/30', 'text' => 'text-red-800 dark:text-red-400', 'label' => 'Ditolak'],
                        ];
                        $statusColor = $statusMap[$r['status']] ?? $statusMap['submitted'];
                    ?>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400"><?php echo e($loop->iteration); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400"><?php echo e($r['kecamatan']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400"><?php echo e($date); ?></td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full <?php echo e($statusColor['bg']); ?> <?php echo e($statusColor['text']); ?>">
                                <?php echo e($statusColor['label']); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="<?php echo e(route('reports.show', $r['ticket'])); ?>"
                                class="text-gray-600 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                title="Lihat Detail">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada laporan. <a href="<?php echo e(route('reports.create')); ?>" class="text-primary hover:underline">Buat laporan pertama Anda</a>.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/pages/laporansaya.blade.php ENDPATH**/ ?>