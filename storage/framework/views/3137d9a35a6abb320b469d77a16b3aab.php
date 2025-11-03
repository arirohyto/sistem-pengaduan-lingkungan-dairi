<header
    class="flex items-center justify-between px-4 py-3 md:px-6 border-b border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-background-dark/70 backdrop-blur">
    <div class="flex items-center gap-3"> <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2"> <img
                src="<?php echo e(asset('images/logo-dlh.png')); ?>" alt="Logo Dairi" class="h-10 w-auto md:h-12 object-contain"
                loading="lazy"> <span class="text-gray-900 dark:text-white text-base md:text-lg font-bold tracking-tight">
                Pemerintah Kabupaten Dairi </span> </a> </div>
    <div class="hidden md:flex flex-1 justify-end items-center gap-6"> <?php $linkBase = 'text-gray-700 dark:text-gray-300 hover:text-primary text-sm font-medium transition-colors'; ?>
        <nav class="flex items-center gap-6">
            <a href="<?php echo e(route('home')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('home') ? 'text-primary' : ''); ?>">Home</a>

            
            <a href="<?php echo e(route('login')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('login') ? 'text-primary' : ''); ?>">Masuk</a>
        </nav>

        <a href="<?php echo e(route('register')); ?>"
            class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90">
            Daftar
        </a>
    </div>
    
    <button
        class="md:hidden inline-flex items-center justify-center rounded-lg p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Open menu">
        <span class="material-symbols-outlined">menu</span>
    </button>

</header>
<?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>