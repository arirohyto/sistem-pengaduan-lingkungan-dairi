@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
    <div class="px-4 sm:px-6 md:px-8 lg:px-10 xl:px-20 py-5">
        <div class="max-w-4xl w-full mx-auto">
            <!-- Heading -->
            <div class="flex flex-wrap justify-between gap-3 px-2 sm:px-4 mb-6">
                <div class="flex w-full sm:max-w-xl flex-col gap-3">
                    <p
                        class="text-text-light dark:text-text-dark text-2xl sm:text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                        Buat Laporan Pengaduan Anda
                    </p>
                    <p class="text-subtle-light dark:text-subtle-dark text-sm sm:text-base">
                        Isi formulir di bawah ini untuk melaporkan pelanggaran lingkungan hidup atau masalah sampah.
                    </p>
                </div>
            </div>

            <!-- Card Form -->
            <div
                class="bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg shadow-sm p-6 sm:p-8">

                <!-- Error Validation -->
                @if ($errors->any())
                    <div
                        class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="flex flex-col gap-8" action="{{ route('laporan.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Jenis Laporan -->
                    <div>
                        <h3 class="text-text-light dark:text-text-dark text-lg font-bold pb-4">Jenis Laporan</h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label
                                class="flex flex-1 items-center gap-4 rounded-lg border border-border-light dark:border-border-dark p-4 cursor-pointer hover:border-primary/50 dark:hover:border-primary/50 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:has-[:checked]:bg-primary/20 transition-colors">
                                <input type="radio" name="jenis_laporan" value="sampah"
                                    class="h-4 w-4 border border-border-light dark:border-border-dark rounded-full
                                        text-primary accent-primary focus:outline-none focus:ring-0"
                                    {{ old('jenis_laporan', 'sampah') == 'sampah' ? 'checked' : '' }}>
                                <p class="text-text-light dark:text-text-dark text-sm font-medium">Sampah</p>
                            </label>
                            <label
                                class="flex flex-1 items-center gap-4 rounded-lg border border-border-light dark:border-border-dark p-4 cursor-pointer hover:border-primary/50 dark:hover:border-primary/50 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:has-[:checked]:bg-primary/20 transition-colors">
                                <input type="radio" name="jenis_laporan" value="lingkungan"
                                    class="h-4 w-4 border border-border-light dark:border-border-dark rounded-full
                                        text-primary accent-primary focus:outline-none focus:ring-0"
                                    {{ old('jenis_laporan') == 'lingkungan' ? 'checked' : '' }}>
                                <p class="text-text-light dark:text-text-dark text-sm font-medium">Lingkungan Hidup</p>
                            </label>
                        </div>
                    </div>

                    <!-- Detail Laporan -->
                    <div>
                        <h3 class="text-text-light dark:text-text-dark text-lg font-bold pb-4">Detail Laporan</h3>
                        <div class="flex flex-col gap-6">
                            <!-- Lokasi -->
                            <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">Lokasi</p>
                                <select name="location_id" required
                                    class="form-select w-full rounded-lg text-sm sm:text-base text-text-light dark:text-text-dark
                                        focus:outline-0 focus:ring-2 focus:ring-primary/50
                                        border border-border-light dark:border-border-dark bg-white dark:bg-background-dark focus:border-primary
                                        h-10 sm:h-11 bg-[image:--select-button-svg] px-3 sm:px-4">
                                    <option value="" disabled selected>Pilih Lokasi Kejadian</option>
                                    @if(isset($lokasis))
                                        @foreach($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id }}" {{ old('location_id') == $lokasi->id ? 'selected' : '' }}>
                                                {{ $lokasi->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </label>

                            <!-- Judul Laporan -->
                            <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">Judul Laporan</p>
                                <input type="text" name="title" value="{{ old('title') }}" required
                                    placeholder="Contoh: Tumpukan sampah di pinggir jalan"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-3 sm:p-4 text-sm sm:text-base text-text-light dark:text-text-dark placeholder:text-xs sm:placeholder:text-sm placeholder:text-subtle-light dark:placeholder:text-subtle-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50 h-10 sm:h-14">
                            </label>

                            <!-- Deskripsi -->
                            <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">
                                    Deskripsi Laporan dan Alamat Lengkap</p>
                                <textarea name="description" rows="4" required
                                    class="form-textarea w-full resize-y rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark
                                            p-3 sm:p-4 text-sm sm:text-base text-text-light dark:text-text-dark
                                            placeholder:text-xs sm:placeholder:text-sm placeholder:text-subtle-light dark:placeholder:text-subtle-dark
                                            focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50"
                                    placeholder="Jelaskan alamat lengkap dan pelanggaran yang Anda lihat secara rinci...">{{ old('description') }}</textarea>
                            </label>

                            <!-- Peta dan Drop Pin -->
                            <div class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">
                                    Pilih Lokasi Pelanggaran
                                </p>
                                <div class="flex gap-2 mb-2">
                                    <button type="button" id="useMyLocation" class="text-xs sm:text-sm px-3 py-1 bg-primary text-white rounded-lg">
                                        Gunakan Lokasi Saya
                                    </button>
                                    <span class="text-xs text-subtle-light dark:text-subtle-dark self-center">
                                        atau klik di peta
                                    </span>
                                </div>
                                <div id="map" class="rounded-lg border border-border-light dark:border-border-dark w-full h-64 sm:h-80"></div>
                                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                                <p class="text-subtle-light dark:text-subtle-dark text-xs sm:text-sm mt-1">
                                    Klik di peta untuk menandai lokasi pelanggaran, atau klik tombol di atas untuk menggunakan lokasi saat ini.
                                </p>
                            </div>

                            <!-- Upload Foto -->
                            <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">Foto Bukti</p>
                                <input type="file" name="photos[]" multiple accept="image/*" required
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark
                                            p-3 sm:p-4 text-sm sm:text-base text-text-light dark:text-text-dark
                                            focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50
                                            h-10 sm:h-14">
                                <p class="text-subtle-light dark:text-subtle-dark text-xs sm:text-sm mt-1">
                                    Minimal 1 foto, Maksimal 3 foto, ukuran masing-masing maksimal 2MB
                                </p>
                            </label>
                        </div>
                    </div>

                    <!-- Kontak Pelapor (Opsional) -->
                    <div>
                        <h3 class="text-text-light dark:text-text-dark text-lg font-bold pb-4">Kontak Pelapor (Opsional)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                           <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">Nomor Telepon</p>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark
                                        p-3 sm:p-4 text-sm sm:text-base text-text-light dark:text-text-dark
                                        placeholder:text-xs sm:placeholder:text-sm placeholder:text-subtle-light dark:placeholder:text-subtle-dark
                                        focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50
                                        h-10 sm:h-14">
                            </label>

                            <label class="flex flex-col">
                                <p class="text-text-light dark:text-text-dark text-sm sm:text-base font-medium pb-2">Email</p>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Contoh: nama@email.com"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark
                                        p-3 sm:p-4 text-sm sm:text-base text-text-light dark:text-text-dark
                                        placeholder:text-xs sm:placeholder:text-sm placeholder:text-subtle-light dark:placeholder:text-subtle-dark
                                        focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50
                                        h-10 sm:h-14">
                            </label>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end pt-4">
                        <button
                            class="flex min-w-[140px] sm:min-w-[160px] items-center justify-center rounded-lg h-10 sm:h-12 px-4 sm:px-6 bg-primary text-white text-sm sm:text-base font-bold hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-colors">
                            <span class="truncate">Kirim Laporan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta
        let map = L.map('map').setView([-2.4967, 98.4444], 12); // Koordinat Dairi

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = null;

        // Fungsi saat peta diklik
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        // Fungsi untuk mendapatkan lokasi pengguna
        document.getElementById('useMyLocation').addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert('Browser Anda tidak mendukung geolokasi.');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Hapus marker lama jika ada
                    if (marker) {
                        map.removeLayer(marker);
                    }

                    // Tandai lokasi pengguna
                    marker = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 15);

                    // Simpan ke form
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                },
                function(error) {
                    alert('Tidak dapat mendapatkan lokasi Anda: ' + error.message);
                }
            );
        });

        // Jika sudah ada latitude dan longitude dari old(), maka tampilkan marker
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        if (lat && lng) {
            marker = L.marker([parseFloat(lat), parseFloat(lng)]).addTo(map);
            map.setView([parseFloat(lat), parseFloat(lng)], 15);
        }
    </script>
@endsection