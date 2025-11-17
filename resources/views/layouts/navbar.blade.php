<header
    class="flex items-center justify-between px-4 py-3 md:px-6 border-b border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-background-dark/70 backdrop-blur">
    <div class="flex items-center gap-3"> <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/logo-dlh.png') }}" alt="Logo DLH Dairi" class="h-16 w-auto md:h-28 object-contain"
                loading="lazy">
            <span class="text-gray-900 dark:text-white text-sm sm:text-base md:text-lg font-bold tracking-tight">
                Pemerintah Kabupaten Dairi
            </span>
        </a>
    </div>

    {{-- TOMBOL MENU UNTUK MOBILE --}}
    <button type="button"
        class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
        aria-label="Toggle navigation" onclick="toggleMobileNav()">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    {{-- NAVBAR MOBILE DROPDOWN --}}
    <nav id="mobileNav"
        class="md:hidden hidden px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark">
        @php
            $linkBase = 'block w-full text-left py-2 text-sm font-medium';
            $linkGuest = 'text-gray-700 dark:text-gray-300 hover:text-primary';
        @endphp

        @auth
            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ Auth::user()->name }}
            </p>

            <a href="{{ route('home') }}"
                class="{{ $linkBase }} {{ request()->routeIs('home') ? 'text-primary' : $linkGuest }}">
                Home
            </a>

            <a href="{{ route('laporan.index') }}"
                class="{{ $linkBase }} {{ request()->routeIs('laporan.*') ? 'text-primary' : $linkGuest }}">
                Laporan Saya
            </a>

            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.*') ? 'text-primary' : $linkGuest }}">
                    Dashboard Admin
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit"
                    class="w-full mt-1 rounded-lg h-9 px-3 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('home') }}"
                class="{{ $linkBase }} {{ request()->routeIs('home') ? 'text-primary' : $linkGuest }}">
                Home
            </a>

            <a href="{{ route('login') }}"
                class="{{ $linkBase }} {{ request()->routeIs('login') ? 'text-primary' : $linkGuest }}">
                Masuk
            </a>

            <a href="{{ route('register') }}"
                class="mt-2 inline-flex items-center justify-center rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                Daftar
            </a>
        @endguest
    </nav>

    {{-- NAV UNTUK DESKTOP --}}
    <div class="hidden md:flex flex-1 justify-end items-center gap-6">
        @php
            $linkBase = 'text-sm font-medium transition-colors';
            $linkGuest = 'text-gray-700 dark:text-gray-300 hover:text-primary';
        @endphp

        @auth
            <nav class="flex items-center gap-6">
                <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
                <a href="{{ route('home') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('home') ? 'text-primary' : $linkGuest }}">Home</a>
                <a href="{{ route('laporan.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('laporan.*') ? 'text-primary' : $linkGuest }}">Laporan
                    Saya</a>

                @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ $linkBase }} {{ request()->routeIs('admin.*') ? 'text-primary' : $linkGuest }}">Dashboard
                        Admin</a>
                @endif
            </nav>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <nav class="flex items-center gap-6">
                <a href="{{ route('home') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('home') ? 'text-primary' : $linkGuest }}">Home</a>
                <a href="{{ route('login') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('login') ? 'text-primary' : $linkGuest }}">Masuk</a>
            </nav>

            <a href="{{ route('register') }}"
                class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                Daftar
            </a>
        @endguest
    </div>
</header>

<script>
    function toggleMobileNav() {
        const nav = document.getElementById('mobileNav');
        if (!nav) return;
        nav.classList.toggle('hidden');
    }
</script>
