@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="px-4 md:px-6 lg:px-10 xl:px-20 py-5">
    <div class="max-w-4xl w-full mx-auto">
        <!-- Heading -->
        <div class="flex flex-wrap justify-between gap-3 p-4 mb-6">
            <div class="flex min-w-72 flex-col gap-3">
                <p class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">
                    Buat Laporan Pengaduan Anda
                </p>
                <p class="text-subtle-light dark:text-subtle-dark text-base">
                    Isi formulir di bawah ini untuk melaporkan pelanggaran lingkungan hidup atau masalah sampah.
                </p>
            </div>
        </div>

        <!-- Card Form -->
        <div class="bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg shadow-sm p-6 sm:p-8">
            
            <!-- Error Validation -->
            @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="flex flex-col gap-8" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Jenis Laporan -->
                <div>
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold pb-4">Jenis Laporan</h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <label class="flex flex-1 items-center gap-4 rounded-lg border border-border-light dark:border-border-dark p-4 cursor-pointer hover:border-primary/50 dark:hover:border-primary/50 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:has-[:checked]:bg-primary/20 transition-colors">
                            <input type="radio" name="jenis_laporan" value="sampah"
                                class="h-5 w-5 border-2 border-border-light dark:border-border-dark bg-transparent text-transparent checked:border-text-light dark:checked:border-text-dark checked:bg-[image:--radio-dot-svg] focus:outline-none focus:ring-0"
                                {{ old('jenis_laporan', 'sampah') == 'sampah' ? 'checked' : '' }}>
                            <p class="text-text-light dark:text-text-dark text-sm font-medium">Sampah</p>
                        </label>
                        <label class="flex flex-1 items-center gap-4 rounded-lg border border-border-light dark:border-border-dark p-4 cursor-pointer hover:border-primary/50 dark:hover:border-primary/50 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:has-[:checked]:bg-primary/20 transition-colors">
                            <input type="radio" name="jenis_laporan" value="lingkungan"
                                class="h-5 w-5 border-2 border-border-light dark:border-border-dark bg-transparent text-transparent checked:border-text-light dark:checked:border-text-dark checked:bg-[image:--radio-dot-svg] focus:outline-none focus:ring-0"
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
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Lokasi</p>
                            <select name="location_id" required
                                class="form-select w-full rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-white dark:bg-background-dark focus:border-primary h-14 bg-[image:--select-button-svg] p-[15px] text-base">
                                <option value="" disabled selected>Pilih Lokasi Kejadian</option>
                                @if(isset($lokasis))
                                    @foreach($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}" {{ old('location_id') == $lokasi->id ? 'selected' : '' }}>
                                            {{ $lokasi->name }} - {{ $lokasi->area->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </label>

                        <!-- Judul Laporan -->
                        <label class="flex flex-col">
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Judul Laporan</p>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                placeholder="Contoh: Tumpukan sampah di pinggir jalan"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-4 text-base text-text-light dark:text-text-dark placeholder:text-subtle-light dark:placeholder:text-subtle-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50 h-14">
                        </label>

                        <!-- Deskripsi -->
                        <label class="flex flex-col">
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Deskripsi Laporan dan Alamat Lengkap</p>
                            <textarea name="description" rows="5" required
                                class="form-textarea w-full resize-y rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-4 text-base text-text-light dark:text-text-dark placeholder:text-subtle-light dark:placeholder:text-subtle-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50"
                                placeholder="Jelaskan alamat lengkap dan pelanggaran yang Anda lihat secara rinci...">{{ old('description') }}</textarea>
                        </label>

                        <!-- Upload Foto -->
                        <label class="flex flex-col">
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Foto Bukti (Opsional)</p>
                            <input type="file" name="photos[]" multiple accept="image/*"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-4 text-base text-text-light dark:text-text-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50 h-14">
                            <p class="text-subtle-light dark:text-subtle-dark text-sm mt-1">
                                Maksimal 3 foto, ukuran masing-masing maksimal 2MB
                            </p>
                        </label>
                    </div>
                </div>

                <!-- Kontak Pelapor (Opsional) -->
                <div>
                    <h3 class="text-text-light dark:text-text-dark text-lg font-bold pb-4">Kontak Pelapor (Opsional)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="flex flex-col">
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Nomor Telepon</p>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-4 text-base text-text-light dark:text-text-dark placeholder:text-subtle-light dark:placeholder:text-subtle-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50 h-14">
                        </label>

                        <label class="flex flex-col">
                            <p class="text-text-light dark:text-text-dark text-base font-medium pb-2">Email</p>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: nama@email.com"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark p-4 text-base text-text-light dark:text-text-dark placeholder:text-subtle-light dark:placeholder:text-subtle-dark focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/50 h-14">
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="flex min-w-[160px] items-center justify-center rounded-lg h-12 px-6 bg-primary text-white text-base font-bold hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-colors">
                        <span class="truncate">Kirim Laporan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection