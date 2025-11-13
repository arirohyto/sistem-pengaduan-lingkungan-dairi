# 📘 PANDUAN BACKEND - PART 6: ROUTES CONFIGURATION

## Complete Routes untuk Sistem Pengaduan Lingkungan

**File:** `routes/web.php`

```php
<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

Route::get('/', [BerandaController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes (Only for non-authenticated users)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (For logged-in users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Laporan - Create & Store
    Route::get('/laporan/buat', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

    // Laporan - Index & Show
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{code}', [LaporanController::class, 'show'])->name('laporan.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Only for admin role)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Laporan Management
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('laporan.destroy');

    // Lokasi Management
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::put('/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');
});

/*
|--------------------------------------------------------------------------
| Fallback Route (404)
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return view('errors.404');
});
```

---

## Route Structure Overview

```
PUBLIC ROUTES (No Auth)
├── GET  /                          → Beranda

GUEST ROUTES (Not Logged In)
├── GET  /login                     → Form login
├── POST /login                     → Process login
├── GET  /register                  → Form register
└── POST /register                  → Process register

AUTH ROUTES (Logged In - Any Role)
├── POST /logout                    → Logout
├── GET  /laporan/buat              → Form buat laporan
├── POST /laporan                   → Submit laporan
├── GET  /laporan                   → List laporan user
└── GET  /laporan/{code}            → Detail laporan

ADMIN ROUTES (Admin Only)
├── GET    /admin/dashboard         → Dashboard admin
├── GET    /admin/laporan           → List semua laporan
├── GET    /admin/laporan/{id}      → Detail laporan
├── PATCH  /admin/laporan/{id}/status → Update status
├── DELETE /admin/laporan/{id}      → Hapus laporan
├── GET    /admin/lokasi            → List lokasi
├── POST   /admin/lokasi            → Tambah lokasi
├── PUT    /admin/lokasi/{id}       → Update lokasi
└── DELETE /admin/lokasi/{id}       → Hapus lokasi
```

---

## Named Routes Reference

### Public Routes
```php
route('home')                       // /
```

### Authentication Routes
```php
route('login')                      // /login
route('register')                   // /register
route('logout')                     // /logout (POST)
```

### User Laporan Routes
```php
route('laporan.create')             // /laporan/buat
route('laporan.store')              // /laporan (POST)
route('laporan.index')              // /laporan
route('laporan.show', $code)        // /laporan/{code}
```

### Admin Routes
```php
route('admin.dashboard')                           // /admin/dashboard
route('admin.laporan.index')                       // /admin/laporan
route('admin.laporan.show', $id)                   // /admin/laporan/{id}
route('admin.laporan.updateStatus', $id)           // /admin/laporan/{id}/status (PATCH)
route('admin.laporan.destroy', $id)                // /admin/laporan/{id} (DELETE)
route('admin.lokasi.index')                        // /admin/lokasi
route('admin.lokasi.store')                        // /admin/lokasi (POST)
route('admin.lokasi.update', $id)                  // /admin/lokasi/{id} (PUT)
route('admin.lokasi.destroy', $id)                 // /admin/lokasi/{id} (DELETE)
```

---

## Usage in Blade Templates

### Navigation Links

```blade
{{-- Public --}}
<a href="{{ route('home') }}">Beranda</a>

{{-- Auth --}}
@guest
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Daftar</a>
@endguest

@auth
    <a href="{{ route('laporan.create') }}">Buat Laporan</a>
    <a href="{{ route('laporan.index') }}">Laporan Saya</a>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth

{{-- Admin --}}
@if(Auth::check() && Auth::user()->isAdmin())
    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
    <a href="{{ route('admin.laporan.index') }}">Kelola Laporan</a>
    <a href="{{ route('admin.lokasi.index') }}">Kelola Lokasi</a>
@endif
```

### Form Actions

```blade
{{-- Login Form --}}
<form action="{{ route('login') }}" method="POST">
    @csrf
    <!-- form fields -->
</form>

{{-- Register Form --}}
<form action="{{ route('register') }}" method="POST">
    @csrf
    <!-- form fields -->
</form>

{{-- Create Laporan --}}
<form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- form fields -->
</form>

{{-- Update Status (Admin) --}}
<form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <!-- form fields -->
</form>

{{-- Delete Laporan (Admin) --}}
<form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
```

### Redirects in Controllers

```php
// Redirect to named route
return redirect()->route('home');

// Redirect with parameters
return redirect()->route('laporan.show', $laporan->code);

// Redirect with flash message
return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat!');

// Redirect back
return back()->with('error', 'Terjadi kesalahan');

// Redirect with input (for validation errors)
return back()->withInput()->withErrors(['email' => 'Email tidak valid']);
```

---

## Route Testing Commands

```bash
# List all routes
php artisan route:list

# List routes with specific name
php artisan route:list --name=admin

# List routes with specific method
php artisan route:list --method=GET

# List routes with specific path
php artisan route:list --path=laporan

# Cache routes (production only)
php artisan route:cache

# Clear route cache
php artisan route:clear
```

---

## API Routes (Optional - Jika Diperlukan)

**File:** `routes/api.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LaporanController;

Route::prefix('v1')->group(function () {
    // Public endpoints
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/{code}', [LaporanController::class, 'show']);

    // Protected endpoints (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/laporan', [LaporanController::class, 'store']);
    });
});
```

---

## Route Model Binding (Advanced)

Jika ingin menggunakan route model binding:

```php
// Di routes/web.php
Route::get('/laporan/{laporan:code}', [LaporanController::class, 'show'])
    ->name('laporan.show');

// Di Controller, parameter otomatis resolved ke Model
public function show(Laporan $laporan)
{
    // $laporan sudah berisi instance dari Laporan model
    return view('pages.detaillaporan', compact('laporan'));
}
```

---

## Middleware Priority

Laravel akan execute middleware dalam urutan:
1. `web` (session, cookies, CSRF protection)
2. `guest` (redirect if authenticated)
3. `auth` (authenticate user)
4. `admin` (check if user is admin)

---

## Rate Limiting (Optional)

Tambahkan rate limiting untuk security:

```php
// Di routes/web.php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute

Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('throttle:3,10'); // 3 attempts per 10 minutes
```

---

## Environment-based Routes

```php
// Di routes/web.php
if (app()->environment('local')) {
    // Development-only routes
    Route::get('/dev/test', function () {
        return 'Development mode';
    });
}
```
