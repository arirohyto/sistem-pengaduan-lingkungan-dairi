

<?php $__env->startSection('title', 'Manajemen User - Sistem Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 sm:p-6">
        <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
            <h1 class="text-zinc-900 dark:text-white text-2xl sm:text-3xl font-bold leading-tight tracking-tight">Manajemen User</h1>
            <a href="<?php echo e(route('admin.users.create')); ?>"
               class="inline-flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors whitespace-nowrap">
               <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
                Tambah User
            </a>
        </div>

        
        <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="mb-4 flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Role</label>
                <select name="role" class="border border-gray-300 rounded-md px-2 py-1.5 text-xs sm:text-sm">
                    <option value="">Semua</option>
                    <option value="admin" <?php echo e(request('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                    <option value="masyarakat" <?php echo e(request('role') === 'masyarakat' ? 'selected' : ''); ?>>Masyarakat</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                <select name="status" class="border border-gray-300 rounded-md px-2 py-1.5 text-xs sm:text-sm">
                    <option value="">Semua</option>
                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                </select>
            </div>
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                       class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-xs sm:text-sm"
                       placeholder="Nama atau email">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-xs sm:text-sm">Filter</button>
                <a href="<?php echo e(route('admin.users.index')); ?>"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md text-xs sm:text-sm">Reset</a>
            </div>
        </form>

        
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Nama</th>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Email</th>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Telepon</th>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Role</th>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Status</th>
                            <th class="px-3 py-2 text-xs sm:text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-3 py-2 text-xs sm:text-sm"><?php echo e($user->name); ?></td>
                                <td class="px-3 py-2 text-xs sm:text-sm"><?php echo e($user->email); ?></td>
                                <td class="px-3 py-2 text-xs sm:text-sm"><?php echo e($user->phone ?? '-'); ?></td>
                                <td class="px-3 py-2 text-xs sm:text-sm">
                                    <form method="POST" action="<?php echo e(route('admin.users.updateRole', $user)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <select name="role" class="border border-gray-300 rounded-md px-2 py-1 text-xs"
                                                onchange="this.form.submit()">
                                            <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                            <option value="masyarakat" <?php echo e($user->role === 'masyarakat' ? 'selected' : ''); ?>>Masyarakat</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-3 py-2 text-xs sm:text-sm">
                                    <form method="POST" action="<?php echo e(route('admin.users.updateStatus', $user)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <select name="status" class="border border-gray-300 rounded-md px-2 py-1 text-xs"
                                                onchange="this.form.submit()">
                                            <option value="active" <?php echo e($user->status === 'active' ? 'selected' : ''); ?>>Aktif</option>
                                            <option value="inactive" <?php echo e($user->status === 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-3 py-2 text-xs sm:text-sm">
                                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                                                title="Hapus User">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-xs sm:text-sm text-gray-500">
                                    Belum ada user.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3">
                <?php echo e($users->withQueryString()->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/users/index.blade.php ENDPATH**/ ?>