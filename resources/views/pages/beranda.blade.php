@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
        <div class="@container py-12 md:py-20">
            <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-center justify-center p-6 text-center"
                style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBrGjpKkNJa2xb29g6DAgiKqCgbrrsA03lIVIhEdrsKcAwibubZG57XqQDkf4pOBo7Gw3pQTLu6i9JwSojSy9Oq27LtjWm6LBal4XY-Bh4vauhMQqJE1-O1pEAH_-8b7_KePEzVUgptiQi6mfc4_JXIYWAWbvZ1SZtI2W0UuWK9ZJnkz4-z_Dr2sUfPHIHvDUF_YIEvy7lk9fPMCsaheQnHR_gpHmtLSdcg5kJ__1XC6TR6F99UPq5AkJQ3zKboMmZXDAtiU4P1JlMl");'>
                <div class="flex flex-col gap-4 max-w-3xl">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-tighter @[480px]:text-5xl"> Pengaduan
                        Pelanggaran Lingkungan Hidup dan Sampah </h1>
                    <h2 class="text-white/90 text-base font-normal leading-normal @[480px]:text-lg"> Mendukung Penanganan Sampah
                        dan Pengawasan Lingkungan Hidup Kabupaten Dairi. </h2>
                </div>
                <p class="text-white/90 text-base font-normal leading-normal max-w-2xl">
                    Platform ini membantu warga melaporkan pelanggaran lingkungan dengan mudah dan cepat, berkontribusi untuk
                    menjaga kebersihan dan kelestarian Kabupaten Dairi.
                </p>

                <div class="flex flex-col sm:flex-row flex-wrap gap-4 justify-center pt-4">
                    <a href="{{ route('laporansaya') }}"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                        <span class="truncate">Cek Laporan</span>
                    </a>
                    <a href="{{ route('buatlaporan') }}"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-white dark:bg-gray-200 text-primary dark:text-primary font-bold leading-normal tracking-[0.015em] hover:bg-gray-50 dark:hover:bg-gray-300 transition-colors text-base">
                        <span class="truncate">Buat Laporan Baru</span>
                    </a>
                </div>
            </div>
        </div> @endsection