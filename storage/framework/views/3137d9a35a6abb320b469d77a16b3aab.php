<header
    class="flex items-center justify-between px-4 py-3 md:px-6 border-b border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-background-dark/70 backdrop-blur">
    <div class="flex items-center gap-3"> <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2">
            <img src="<?php echo e(asset('images/logo-dlh.png')); ?>" alt="Logo DLH Dairi" class="h-16 w-auto md:h-28 object-contain"
                loading="lazy">
            <span class="text-gray-900 dark:text-white text-base md:text-lg font-bold tracking-tight">
                Pemerintah Kabupaten Dairi </span> </a> </div>
    <div class="hidden md:flex flex-1 justify-end items-center gap-6">
        <?php
            $linkBase = 'text-sm font-medium transition-colors';
            $linkGuest = 'text-gray-700 dark:text-gray-300 hover:text-primary';
        ?>
        
        <?php if(auth()->guard()->check()): ?>
            <nav class="flex items-center gap-6">
                <span class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?php echo e(Auth::user()->name); ?></span>
                <a href="<?php echo e(route('home')); ?>"
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('home') ? 'text-primary' : $linkGuest); ?>">Home</a>
                <a href="<?php echo e(route('laporan.index')); ?>"
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('laporan.*') ? 'text-primary' : $linkGuest); ?>">Laporan Saya</a>
                
                <?php if(Auth::user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('admin.*') ? 'text-primary' : $linkGuest); ?>">Dashboard Admin</a>
                <?php endif; ?>
            </nav>
            
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    Logout
                </button>
            </form>
        <?php endif; ?>
        
        <?php if(auth()->guard()->guest()): ?>
            <nav class="flex items-center gap-6">
                <a href="<?php echo e(route('home')); ?>"
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('home') ? 'text-primary' : $linkGuest); ?>">Home</a>
                <a href="<?php echo e(route('login')); ?>"
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('login') ? 'text-primary' : $linkGuest); ?>">Masuk</a>
            </nav>
            
            <a href="<?php echo e(route('register')); ?>"
                class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                Daftar
            </a>
        <?php endif; ?>
    </div>
</header>
<?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>