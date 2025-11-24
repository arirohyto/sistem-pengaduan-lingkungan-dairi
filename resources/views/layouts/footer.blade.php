<footer class="mt-8 bg-[#2c9f8f] text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="grid gap-8 md:grid-cols-2">
            <div>
                <h2 class="text-sm sm:text-base font-bold tracking-wide mb-3">
                    SPPLH Dairi
                </h2>
                <div class="h-px w-12 bg-white/40 mb-4"></div>
                <p class="text-xs sm:text-sm leading-relaxed mb-4">
                    SPPLH Dairi merupakan aplikasi layanan aspirasi dan pengaduan masyarakat terkait lingkungan hidup dan sampah di Kabupaten Dairi.
                </p>
                <div class="flex flex-wrap items-center gap-4 mt-4">
                    <img
                        src="{{ asset('images/logopemerintahkabdairi.png') }}"
                        alt="Pemerintah Kabupaten Dairi"
                        class="h-16 w-auto sm:h-20 object-contain"
                    >
                </div>
            </div>
            <div>
                <h2 class="text-sm sm:text-base font-bold tracking-wide mb-3">
                    Hubungi Kami
                </h2>
                <div class="h-px w-12 bg-white/40 mb-4"></div>
                <p class="text-xs sm:text-sm font-semibold mb-1">
                    Dinas Komunikasi dan Informatika
                </p>
                <p class="text-xs sm:text-sm mb-3">
                    Pemerintah Kabupaten Dairi
                </p>

                <p class="text-xs sm:text-sm mb-1">
                    <span class="font-semibold">Alamat:</span>
                    Jalan Gereja Nomor 2 Sidikalang
                </p>
                <p class="text-xs sm:text-sm mb-1">
                    <span class="font-semibold">Email:</span>
                    diskominfo@dairikab.go.id
                </p>
                <p class="text-xs sm:text-sm">
                    <span class="font-semibold">Website:</span>
                    <a href="https://diskominfo.dairikab.go.id" target="_blank"
                       class="underline hover:text-white">
                        https://diskominfo.dairikab.go.id
                    </a>
                </p>
            </div>
        </div>

        {{-- Baris bawah --}}
        <div class="mt-8 border-t border-white/20 pt-4 text-center text-[11px] sm:text-xs">
            Copyright &copy; {{ date('Y') }}
            Pemerintah Kabupaten Dairi |
            Dinas Komunikasi dan Informatika
        </div>
    </div>
</footer>