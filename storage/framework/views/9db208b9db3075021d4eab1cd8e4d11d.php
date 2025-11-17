

<?php $__env->startSection('title', 'Admin Dashboard - Sistem Pengaduan Lingkungan'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
        <!-- Page Content Area -->
        <div class="p-4 sm:p-6">
            <!-- Error/Success Messages -->
            <?php if(session('success')): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="flex flex-wrap justify-between gap-2 mb-4">
                <p class="text-zinc-900 dark:text-white text-2xl sm:text-3xl font-bold leading-tight tracking-tight">Dashboard Admin</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">
                <div class="bg-white dark:bg-zinc-800 rounded-lg p-3 sm:p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Total Laporan</p>
                            <p class="text-xl sm:text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['total_laporan'] ?? 0); ?>

                            </p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900 p-2 sm:p-3 rounded-lg">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-300 text-base sm:text-lg">description</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-3 sm:p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Menunggu</p>
                            <p class="text-xl sm:text-2x1 font-bold text-yellow-600"><?php echo e($stats['pending'] ?? 0); ?></p>
                        </div>
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-2 sm:p-3 rounded-lg">
                            <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-300 text-base sm:text-lg">schedule</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-3 sm:p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Diproses</p>
                            <p class="text-xl sm:text-2xl font-bold text-blue-600"><?php echo e($stats['diproses'] ?? 0); ?></p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900 p-2 sm:p-3 rounded-lg">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-300 text-base sm:text-lg">autorenew</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-3 sm:p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Selesai</p>
                            <p class="text-xl sm:text-2xl font-bold text-green-600"><?php echo e($stats['selesai'] ?? 0); ?></p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-2 sm:p-3 rounded-lg">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-300 text-base sm:text-lg">check_circle</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-lg p-3 sm:p-4 shadow-sm border border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Total User</p>
                            <p class="text-xl text-2xl font-bold text-purple-600"><?php echo e($stats['total_users'] ?? 0); ?></p>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-900 p-2 sm:p-3 rounded-lg">
                            <span class="material-symbols-outlined text-purple-600 dark:text-purple-300 text-base sm:text-lg">people</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-background-light dark:bg-background-dark">
                            <tr>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Kode</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Judul</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Pelapor</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Lokasi</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Tanggal</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Status</th>
                                <th class="px-3 py-2 sm:px-4 sm:py-3 text-left text-zinc-900 dark:text-white text-xs sm:text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                            <?php if($recentReports->count() == 0): ?>
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada laporan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $recentReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2 text-zinc-900 dark:text-white text-xs sm:text-sm font-mono">
                                            <?php echo e($report->code); ?>

                                        </td>
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2 text-zinc-600 dark:text-zinc-400 text-xs sm:text-sm">
                                            <?php echo e($report->title); ?>

                                        </td>
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2 text-zinc-600 dark:text-zinc-400 text-xs sm:text-sm">
                                            <?php echo e($report->reporter_name ?? 'Anonim'); ?>

                                        </td>
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2 text-zinc-600 dark:text-zinc-400 text-xs sm:text-sm">
                                            <?php echo e($report->location->name ?? '-'); ?>

                                        </td>
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2 text-zinc-600 dark:text-zinc-400 text-xs sm:text-sm">
                                            <?php echo e($report->created_at->translatedFormat('d M Y')); ?>

                                        </td>
                                        <td class="h-[72px] px-4 py-2">
                                            <span
                                                class="inline-flex items-center justify-center rounded-full h-6 sm:h-7 px-2.5 sm:px-3 
                                                    <?php echo e($report->status_badge['bg']); ?> <?php echo e($report->status_badge['text']); ?> 
                                                    text-[11px] sm:text-xs font-medium">
                                                <?php echo e($report->status_label); ?>

                                            </span>
                                        </td>
                                        <td class="h-[60px] px-3 py-2 sm:px-4 sm:py-2">
                                            <div class="flex items-center gap-1.5 sm:gap-2">
                                                <a href="<?php echo e(route('admin.laporan.show', $report->id)); ?>"
                                                    class="p-1.5 sm:p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-sm sm:text-base">visibility</span>
                                                </a>
                                                <button
                                                    onclick="openStatusModal(<?php echo e($report->id); ?>, '<?php echo e($report->status); ?>')"
                                                    class="p-1.5 sm:p-2 rounded-lg text-zinc-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700">
                                                    <span class="material-symbols-outlined text-sm sm:text-base">edit</span>
                                                </button>
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

    <!-- Status Update Modal -->
    <div id="updateStatusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-md mx-4 shadow-xl">
            <h2 class="text-xl font-bold mb-4">Update Status Laporan</h2>
            <hr class="mb-4">

            <form id="statusUpdateForm" method="POST" action="<?php echo e(route('admin.laporan.updateStatus')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
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

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>