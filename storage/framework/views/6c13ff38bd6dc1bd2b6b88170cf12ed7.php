

<?php $__env->startSection('title', 'Tambah User - Sistem Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 sm:p-6 max-w-xl">
        <h1 class="text-zinc-900 dark:text-white text-2xl font-bold mb-4">Tambah User</h1>

        <?php if($errors->any()): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>- <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Telepon</label>
                <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Role</label>
                <select name="role" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="admin" <?php echo e(old('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                    <option value="masyarakat" <?php echo e(old('role') === 'masyarakat' ? 'selected' : ''); ?>>Masyarakat</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="active" <?php echo e(old('status') === 'active' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.users.index')); ?>"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md text-sm">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md text-sm font-bold hover:bg-primary/90">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/admin/users/create.blade.php ENDPATH**/ ?>