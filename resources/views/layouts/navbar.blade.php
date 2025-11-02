<header class="flex items-center justify-between px-4 py-4 md:px-6 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center gap-4">
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logo-dlh.png') }}"
                 alt="Logo Dairi"
                 class="w-[160px] h-[160px] md:w-[160px] md:h-[100px] object-contain">
        </a>
        <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-tight">
            Pemerintah Kabupaten Dairi
        </h2>
    </div>

    <div class="hidden md:flex flex-1 justify-end items-center gap-8">
        <nav class="flex items-center gap-6">
            <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary text-sm font-medium">Home</a>
            <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary text-sm font-medium">Masuk</a>
        </nav>
        <a href="#" class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90">
            Daftar
        </a>
    </div>
</header>
