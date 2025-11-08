

<?php $__env->startSection('title', 'Admin Dashboard - Sistem Pengaduan Lingkungan'); ?>

<?php $__env->startSection('content'); ?>
    <?php
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
    ?>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">

        <!-- Page Content Area -->
        <div class="p-6">
            <div class="flex flex-wrap justify-between gap-3 mb-6">
                <p class="text-zinc-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">Daftar
                    Laporan Pengaduan</p>
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
                            <?php if(empty($reports)): ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada
                                        laporan.</td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                        <td class="h-[72px] px-4 py-2 text-zinc-900 dark:text-white text-sm">
                                            <?php echo e($report['judul']); ?></td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            <?php echo e($report['pelapor'] ?? 'Anonim'); ?></td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            <?php echo e($report['lokasi']); ?></td>
                                        <td class="h-[72px] px-4 py-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                            <?php echo e($report['tanggal']); ?></td>
                                        <td class="h-[72px] px-4 py-2">
                                            <?php
                                                $statusClass = match ($report['status']) {
                                                    'Selesai' => 'bg-primary/20 text-primary',
                                                    'Diproses'
                                                        => 'bg-status-yellow/20 text-yellow-800 dark:text-yellow-300',
                                                    'Ditolak' => 'bg-status-red/20 text-red-700 dark:text-red-300',
                                                    default
                                                        => 'bg-gray-200 dark:bg-zinc-700 text-gray-800 dark:text-gray-300',
                                                };
                                            ?>
                                            <span
                                                class="inline-flex items-center justify-center rounded-full h-7 px-3 <?php echo e($statusClass); ?> text-xs font-medium">
                                                <?php echo e($report['status']); ?>

                                            </span>
                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <a href="#"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                <a href="#"
                                                    class="p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-base">history</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>