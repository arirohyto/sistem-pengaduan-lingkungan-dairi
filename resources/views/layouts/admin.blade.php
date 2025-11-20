<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin - SPPLH Dairi')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#29a847",
                        "background-light": "#f6f8f6",
                        "background-dark": "#131f16",
                        "status-yellow": "#FFC107",
                        "status-red": "#DC3545",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    @stack('styles')
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar Admin -->
        <aside
            class="w-full md:w-64 bg-white dark:bg-background-dark
                border-b md:border-b-0 md:dark:border-r dark:border-gray-800
                p-4 flex flex-col items-center md:items-stretch gap-4 md:gap-0">
            <div class="flex justify-center md:mb-6">
                <img src="{{ asset('images/logo-dlh.png') }}" alt="Logo DLH Dairi"
                    class="w-40 h-auto md:w-44 lg:w-52 object-contain">
            </div>

            <nav class="flex flex-1 flex-row md:flex-col gap-2 md:mt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/20 text-primary' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <p class="text-sm font-medium">Dashboard</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.lokasi.*') ? 'bg-primary/20 text-primary' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}" href="{{ route('admin.lokasi.index') }}">
                    <span class="material-symbols-outlined">place</span>
                    <p class="text-sm font-medium">Manajemen Lokasi</p>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header Admin (opsional) -->
            <header class="flex justify-between items-center gap-2 px-6 py-3 bg-primary text-white sticky top-0 z-10">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">shield_person</span>
                    <p class="text-sm font-medium">
                        Admin - {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-2">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/20">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </header>

            <!-- Konten Halaman -->
            <div class="p-4 sm:p-6">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>