# 🚀 QUICK START GUIDE - Implementasi Backend

> **Panduan Cepat** untuk mengimplementasikan backend Sistem Pengaduan Lingkungan Hidup dari awal sampai selesai.

---

## 📋 Checklist Implementasi

Gunakan checklist ini untuk melacak progress implementasi:

- [ ] 1. Setup Environment & Dependencies
- [ ] 2. Create Database Migrations
- [ ] 3. Create Eloquent Models
- [ ] 4. Create Database Seeders
- [ ] 5. Run Migrations & Seeders
- [ ] 6. Create Controllers
- [ ] 7. Create Middleware
- [ ] 8. Update Routes
- [ ] 9. Update Views (Blade Templates)
- [ ] 10. Testing & Debugging

---

## 🎯 Step-by-Step Implementation

### Step 1: Setup Environment (5 menit)

```bash
# 1. Copy .env file jika belum
cp .env.example .env

# 2. Generate application key
php artisan key:generate

# 3. Configure database di .env
# Edit file .env untuk MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pengaduan_lingkungan
DB_USERNAME=root
DB_PASSWORD=

# 3.1 Buat database MySQL terlebih dahulu
# Buka phpMyAdmin atau MySQL client, lalu jalankan:
# CREATE DATABASE sistem_pengaduan_lingkungan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 4. Install dependencies
composer install
npm install

# 5. Create symbolic link untuk storage
php artisan storage:link
```

---

### Step 2: Create Migrations (15 menit)

Lihat detail di: **BACKEND_GUIDE_01_MIGRATIONS.md**

```bash
# Generate migration files
php artisan make:migration create_kategori_table
php artisan make:migration create_area_table
php artisan make:migration create_lokasi_table
php artisan make:migration create_laporan_table
php artisan make:migration create_lampiran_laporan_table
php artisan make:migration create_riwayat_perubahan_status_table
php artisan make:migration update_users_table
```

**Copy kode dari BACKEND_GUIDE_01_MIGRATIONS.md** ke setiap migration file.

---

### Step 3: Create Models (15 menit)

Lihat detail di: **BACKEND_GUIDE_02_MODELS.md**

```bash
# Generate model files
php artisan make:model Kategori
php artisan make:model Area
php artisan make:model Lokasi
php artisan make:model Laporan
php artisan make:model LampiranLaporan
php artisan make:model RiwayatPerubahanStatus
```

**Copy kode dari BACKEND_GUIDE_02_MODELS.md** ke setiap model file.

**Update** `app/Models/User.php` dengan kode dari guide.

---

### Step 4: Create Seeders (10 menit)

Lihat detail di: **BACKEND_GUIDE_03_SEEDERS.md**

```bash
# Generate seeder files
php artisan make:seeder UserSeeder
php artisan make:seeder KategoriSeeder
php artisan make:seeder AreaSeeder
php artisan make:seeder LokasiSeeder
```

**Copy kode dari BACKEND_GUIDE_03_SEEDERS.md** ke setiap seeder file.

**Update** `database/seeders/DatabaseSeeder.php`

---

### Step 5: Run Migrations & Seeders (2 menit)

```bash
# Run migrations dan seeders sekaligus
php artisan migrate:fresh --seed

# Atau jalankan terpisah:
php artisan migrate
php artisan db:seed
```

✅ **Cek database** untuk memastikan semua tabel terisi.

---

### Step 6: Create Controllers (20 menit)

Lihat detail di: **BACKEND_GUIDE_04_CONTROLLERS.md**

```bash
# Auth Controllers
php artisan make:controller Auth/LoginController
php artisan make:controller Auth/RegisterController
php artisan make:controller Auth/LogoutController

# Public Controllers
php artisan make:controller BerandaController
php artisan make:controller LaporanController

# Admin Controllers
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/LaporanController
php artisan make:controller Admin/LokasiController
```

**Copy kode dari BACKEND_GUIDE_04_CONTROLLERS.md** ke setiap controller file.

---

### Step 7: Create Middleware (5 menit)

Lihat detail di: **BACKEND_GUIDE_05_MIDDLEWARE_AUTH.md**

```bash
# Generate middleware files
php artisan make:middleware IsAdmin
php artisan make:middleware IsMasyarakat
```

**Copy kode dari BACKEND_GUIDE_05_MIDDLEWARE_AUTH.md**

**Update** `bootstrap/app.php` untuk register middleware aliases.

---

### Step 8: Update Routes (5 menit)

Lihat detail di: **BACKEND_GUIDE_06_ROUTES.md**

**Replace** seluruh isi file `routes/web.php` dengan kode dari guide.

---

### Step 9: Update Views (30 menit)

Views perlu disesuaikan untuk menggunakan data dari controller, bukan hardcoded.

#### 9.1 Update Login Form

**File:** `resources/views/auth/login.blade.php`

```blade
<form action="{{ route('login') }}" method="POST">
    @csrf
    
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="password" name="password" required>
    <input type="checkbox" name="remember" value="1">
    
    <button type="submit">Login</button>
</form>
```

#### 9.2 Update Register Form

**File:** `resources/views/auth/register.blade.php`

```blade
<form action="{{ route('register') }}" method="POST">
    @csrf
    
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <input type="text" name="name" value="{{ old('name') }}" required>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="text" name="phone" value="{{ old('phone') }}">
    <input type="password" name="password" required>
    <input type="password" name="password_confirmation" required>
    
    <button type="submit">Daftar</button>
</form>
```

#### 9.3 Update Navbar with Auth

**File:** `resources/views/layouts/navbar.blade.php`

```blade
<nav>
    <a href="{{ route('home') }}">Beranda</a>
    
    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Daftar</a>
    @endguest
    
    @auth
        <span>Halo, {{ Auth::user()->name }}</span>
        <a href="{{ route('laporan.create') }}">Buat Laporan</a>
        <a href="{{ route('laporan.index') }}">Laporan Saya</a>
        
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        @endif
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
</nav>
```

#### 9.4 Update Laporan Form

**File:** `resources/views/pages/buatlaporan.blade.php`

Ubah form action dari mock ke real:

```blade
<form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    {{-- Kategori dropdown dari database --}}
    <select name="category_id" required>
        <option value="">Pilih Kategori</option>
        @foreach($categories as $cat)
            <optgroup label="{{ $cat->name }}">
                @foreach($cat->children as $child)
                    <option value="{{ $child->id }}">{{ $child->name }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    
    {{-- Lokasi dropdown dari database --}}
    <select name="location_id" required>
        <option value="">Pilih Lokasi</option>
        @foreach($lokasis as $lok)
            <option value="{{ $lok->id }}">{{ $lok->name }} - {{ $lok->area->name }}</option>
        @endforeach
    </select>
    
    {{-- Area dropdown dari database --}}
    <select name="area_id" required>
        <option value="">Pilih Kecamatan</option>
        @foreach($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
    </select>
    
    <input type="text" name="title" required>
    <textarea name="description" required></textarea>
    <input type="file" name="photos[]" multiple accept="image/*">
    
    <button type="submit">Kirim Laporan</button>
</form>
```

#### 9.5 Update Laporan List

**File:** `resources/views/pages/laporansaya.blade.php`

```blade
@foreach($laporan as $lap)
    <tr>
        <td>{{ $lap->code }}</td>
        <td>{{ $lap->title }}</td>
        <td>{{ $lap->location->name }}</td>
        <td>{{ $lap->created_at->format('d M Y') }}</td>
        <td>
            <span class="{{ $lap->status_badge['bg'] }} {{ $lap->status_badge['text'] }}">
                {{ $lap->status_label }}
            </span>
        </td>
        <td>
            <a href="{{ route('laporan.show', $lap->code) }}">Lihat Detail</a>
        </td>
    </tr>
@endforeach

{{ $laporan->links() }} {{-- Pagination --}}
```

#### 9.6 Update Admin Dashboard

**File:** `resources/views/admin/dashboard.blade.php`

Replace hardcoded data dengan real data:

```blade
{{-- Stats Cards --}}
<div>Total Laporan: {{ $stats['total_laporan'] }}</div>
<div>Pending: {{ $stats['pending'] }}</div>
<div>Diproses: {{ $stats['diproses'] }}</div>
<div>Selesai: {{ $stats['selesai'] }}</div>

{{-- Recent Reports Table --}}
@foreach($recentReports as $report)
    <tr>
        <td>{{ $report->code }}</td>
        <td>{{ $report->title }}</td>
        <td>{{ $report->location->name }}</td>
        <td>{{ $report->status_label }}</td>
        <td>
            <a href="{{ route('admin.laporan.show', $report->id) }}">Detail</a>
        </td>
    </tr>
@endforeach
```

---

### Step 10: Testing (15 menit)

```bash
# 1. Start development server
php artisan serve

# 2. Buka browser: http://localhost:8000
```

#### Test Checklist:

✅ **Public Pages**
- [ ] Akses beranda tanpa login
- [ ] Tampil stats laporan

✅ **Authentication**
- [ ] Register user baru
- [ ] Login dengan kredensial yang baru dibuat
- [ ] Cek redirect berdasarkan role
- [ ] Logout

✅ **User Features** (Login as Masyarakat)
- [ ] Buat laporan baru
- [ ] Upload foto
- [ ] Lihat daftar laporan sendiri
- [ ] Lihat detail laporan

✅ **Admin Features** (Login as Admin)
- [ ] Akses dashboard admin
- [ ] Lihat semua laporan
- [ ] Update status laporan
- [ ] Tambah lokasi baru
- [ ] Edit lokasi
- [ ] Hapus lokasi

---

## 🐛 Troubleshooting

### Error: Class not found
```bash
composer dump-autoload
php artisan clear-compiled
php artisan config:clear
```

### Error: SQLSTATE Connection refused
```bash
# Check .env database config
# Pastikan MySQL service sudah running di Laragon
# Pastikan database sudah dibuat:
# CREATE DATABASE sistem_pengaduan_lingkungan;

# Test koneksi MySQL:
php artisan tinker
>>> DB::connection()->getPdo();
```

### Error: 419 Page Expired (CSRF)
- Pastikan @csrf ada di semua form
- Clear browser cache
- Check session config

### Error: Storage link tidak work
```bash
php artisan storage:link
# Atau manual:
# mklink /D "public\storage" "..\storage\app\public"
```

### Error: Permission denied di storage
```bash
# Windows (run as admin)
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T
```

---

## 📦 Backup & Version Control

```bash
# Commit ke git
git add .
git commit -m "Implement backend: migrations, models, controllers, auth"
git push

# Backup database MySQL
mysqldump -u root sistem_pengaduan_lingkungan > backup_$(date +%Y%m%d).sql

# Restore backup:
# mysql -u root sistem_pengaduan_lingkungan < backup_20241112.sql
```

---

## 🚀 Production Deployment

```bash
# Optimize untuk production
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set APP_DEBUG=false di .env
# Set APP_ENV=production di .env

# Generate secure APP_KEY
php artisan key:generate --force
```

---

## 📚 Additional Resources

- Laravel Documentation: https://laravel.com/docs
- Eloquent Relationships: https://laravel.com/docs/eloquent-relationships
- Validation Rules: https://laravel.com/docs/validation
- Blade Templates: https://laravel.com/docs/blade

---

## ✅ Completion Checklist

Setelah semua selesai, pastikan:

- [x] Database terisi dengan data seeder
- [x] Login/Register berfungsi
- [x] User bisa buat laporan
- [x] Admin bisa kelola laporan
- [x] Upload foto berfungsi
- [x] Status laporan bisa diubah
- [x] Riwayat perubahan status tercatat
- [x] Authorization (admin/user) berfungsi
- [x] Validation error tampil di form
- [x] Flash message success/error tampil

---

## 🎉 Selamat!

Backend sistem pengaduan lingkungan Anda sudah siap!

**Next Steps:**
- Tambah fitur notifikasi email
- Implementasi export PDF/Excel
- Tambah charts di dashboard
- Optimize query performance
- Add automated testing
