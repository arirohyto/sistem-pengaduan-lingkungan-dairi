<?php $__env->startSection('title', 'Daftar'); ?>
<?php $__env->startSection('content'); ?>
    <div class="relative flex min-h-[70vh] w-full flex-col">
        <main class="flex justify-center px-4 py-8 sm:py-12 md:py-16">
            <div class="w-full max-w-lg space-y-8">
                <!-- Heading -->
                <div class="flex flex-col items-center mb-6">
                    <p
                        class="text-text-dark dark:text-text-light text-2xl sm:text-3xl md:text-4xl font-black tracking-[-0.033em]">
                        DAFTAR
                    </p>
                </div>

                <!-- Form Container -->
                <div
                    class="flex flex-col gap-6 p-6 sm:p-8 border border-primary/30 rounded-lg bg-white dark:bg-black/20 shadow-sm">

                    
                    <?php if($errors->any()): ?>
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form class="flex flex-col gap-6" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Nama -->
                        <label class="flex flex-col w-full">
                            <p class="text-sm sm:text-base font-medium pb-2">Nama</p>
                            <input 
                                type="text" 
                                name="name" 
                                value="<?php echo e(old('name')); ?>"
                                placeholder="Masukkan nama lengkap Anda" 
                                required 
                                class="form-input w-full rounded text-text-dark dark:text-text-light
                                        focus:outline-0 focus:ring-2 focus:ring-primary/50
                                        border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark
                                        h-10 sm:h-12 px-3 sm:px-4 text-sm sm:text-base
                                        placeholder:text-xs sm:placeholder:text-sm text-gray-500 dark:placeholder:text-gray-400" />
                        </label>

                        <!-- Email -->
                        <label class="flex flex-col w-full">
                            <p class="text-sm sm:text-base font-medium pb-2">Email</p>
                            <input 
                                type="email" 
                                name="email" 
                                value="<?php echo e(old('email')); ?>" 
                                placeholder="contoh@email.com"
                                required
                                class="form-input w-full rounded text-text-dark dark:text-text-light
                                        focus:outline-0 focus:ring-2 focus:ring-primary/50
                                        border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark
                                        h-10 sm:h-12 px-3 sm:px-4 text-sm sm:text-base
                                        placeholder:text-xs sm:placeholder:text-sm text-gray-500 dark:placeholder:text-gray-400" />
                        </label>

                        <!-- No HP -->
                        <label class="flex flex-col w-full">
                            <p class="text-sm sm:text-base font-medium pb-2">No. HP</p>
                            <input 
                                type="text" 
                                name="phone" 
                                value="<?php echo e(old('phone')); ?>" 
                                placeholder="08123456789"
                                required
                                class="form-input w-full rounded text-text-dark dark:text-text-light
                                        focus:outline-0 focus:ring-2 focus:ring-primary/50
                                        border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark
                                        h-10 sm:h-12 px-3 sm:px-4 text-sm sm:text-base
                                        placeholder:text-xs sm:placeholder:text-sm text-gray-500 dark:placeholder:text-gray-400" />
                        </label>

                        <!-- Password -->
                        <label class="flex flex-col w-full">
                            <p class="text-sm sm:text-base font-medium pb-2">Kata Sandi</p>
                            <div class="relative">
                                <input 
                                    type="password"
                                    name="password" 
                                    placeholder="Buat kata sandi" 
                                    required
                                    class="form-input w-full rounded text-text-dark dark:text-text-light
                                            focus:outline-0 focus:ring-2 focus:ring-primary/50
                                            border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark
                                            h-10 sm:h-12 px-3 sm:px-4 text-sm sm:text-base
                                            placeholder:text-xs sm:placeholder:text-sm text-gray-500 dark:placeholder:text-gray-400" />
                            </div>
                        </label>

                        <!-- Konfirmasi Password -->
                        <label class="flex flex-col w-full">
                            <p class="text-sm sm:text-base font-medium pb-2">Ulangi Kata Sandi</p>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    placeholder="Konfirmasi kata sandi Anda"
                                    required
                                    class="form-input w-full rounded text-text-dark dark:text-text-light
                                            focus:outline-0 focus:ring-2 focus:ring-primary/50
                                            border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark
                                            h-10 sm:h-12 px-3 sm:px-4 text-sm sm:text-base
                                            placeholder:text-xs sm:placeholder:text-sm text-gray-500 dark:placeholder:text-gray-400" />
                            </div>
                        </label>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                                Sudah punya akun?
                                <a href="<?php echo e(route('login')); ?>" class="font-medium text-primary hover:underline">Masuk</a>
                            </p>
                            <button
                                type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center h-10 sm:h-11 px-5 sm:px-6
                                    rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90">
                                DAFTAR
                            </button>
                        </div>  
                    </form>
                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/auth/register.blade.php ENDPATH**/ ?>