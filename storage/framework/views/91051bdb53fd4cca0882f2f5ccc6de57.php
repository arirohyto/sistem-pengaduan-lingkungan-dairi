 <?php $__env->startSection('title', 'Masuk'); ?> <?php $__env->startSection('content'); ?> <div
    class="flex flex-1 justify-center py-10 sm:py-16 md:py-20 px-4">
    <div class="layout-content-container flex flex-col max-w-md w-full"> <!-- Heading -->
        <div class="flex flex-col items-center mb-8">
            <p class="text-text-dark dark:text-text-light text-4xl font-black tracking-[-0.033em]">MASUK</p>
        </div> <!-- Form Container -->
        <div
            class="flex flex-col gap-6 p-6 sm:p-8 border border-primary/30 rounded-lg bg-white dark:bg-black/20 shadow-sm">
            <form class="flex flex-col gap-6" method="POST" action="#"> <?php echo csrf_field(); ?> <!-- Email --> <label
                    class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Email</p> <input type="email" placeholder="contoh@email.com"
                        class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base" />
                </label> <!-- Password --> <label class="flex flex-col w-full">
                    <p class="text-base font-medium pb-2">Kata Sandi</p>
                    <div class="relative"> <input type="password" placeholder="Masukkan kata sandi Anda"
                            class="form-input w-full rounded text-text-dark dark:text-text-light focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-3 text-base" />
                    </div>
                </label>
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <p class="text-sm text-gray-600 dark:text-gray-300"> Belum punya akun? <a
                            href="<?php echo e(route('register')); ?>" class="font-medium text-primary hover:underline">Daftar</a>
                    </p> <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center h-11 px-6 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90">
                        MASUK </button>
                </div>
            </form>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/auth/login.blade.php ENDPATH**/ ?>