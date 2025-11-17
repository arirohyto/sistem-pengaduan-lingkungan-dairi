<header
    class="flex items-center justify-between px-4 py-3 md:px-6 border-b border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-background-dark/70 backdrop-blur">
    <div class="flex items-center gap-3"> <a href="<?php echo e(route('home')); ?>" class="flex items-center">
            <img src="<?php echo e(asset('images/logo-dlh.png')); ?>" alt="Logo DLH Dairi" class="h-16 w-auto md:h-28 object-contain"
                loading="lazy">
            <span class="text-gray-900 dark:text-white text-sm sm:text-base md:text-lg font-bold tracking-tight">
                Pemerintah Kabupaten Dairi
            </span>
        </a>
    </div>

    
    <button type="button"
        class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Toggle navigation" onclick="toggleMobileNav()">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    
    <nav id="mobileNav"
        class="md:hidden hidden px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark">
        <?php
            $linkBase = 'block w-full text-left py-2 text-sm font-medium';
            $linkGuest = 'text-gray-700 dark:text-gray-300 hover:text-primary';
        ?>

        <?php if(auth()->guard()->check()): ?>
            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                <?php echo e(Auth::user()->name); ?>

            </p>

            <a href="<?php echo e(route('home')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('home') ? 'text-primary' : $linkGuest); ?>">
                Home
            </a>

            <a href="<?php echo e(route('laporan.index')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('laporan.*') ? 'text-primary' : $linkGuest); ?>">
                Laporan Saya
            </a>

            <?php if(Auth::user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('admin.*') ? 'text-primary' : $linkGuest); ?>">
                    Dashboard Admin
                </a>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="w-full mt-1 rounded-lg h-9 px-3 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    Logout
                </button>
            </form>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('home')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('home') ? 'text-primary' : $linkGuest); ?>">
                Home
            </a>

            <a href="<?php echo e(route('login')); ?>"
                class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('login') ? 'text-primary' : $linkGuest); ?>">
                Masuk
            </a>

            <a href="<?php echo e(route('register')); ?>"
                class="mt-2 inline-flex items-center justify-center rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                Daftar
            </a>
        <?php endif; ?>
    </nav>

    
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
                    class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('laporan.*') ? 'text-primary' : $linkGuest); ?>">Laporan
                    Saya</a>

                <?php if(Auth::user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="<?php echo e($linkBase); ?> <?php echo e(request()->routeIs('admin.*') ? 'text-primary' : $linkGuest); ?>">Dashboard
                        Admin</a>
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

<script>
    function toggleMobileNav() {
        const nav = document.getElementById('mobileNav');
        if (!nav) return;
        nav.classList.toggle('hidden');
    }
</script>
<?php /**PATH D:\laragon\www\sistem-pengaduan-lingkungan\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>