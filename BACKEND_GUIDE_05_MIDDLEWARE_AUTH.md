# 📘 PANDUAN BACKEND - PART 5: MIDDLEWARE & AUTHENTICATION

## Middleware untuk Authorization

### Command untuk membuat middleware:

```bash
php artisan make:middleware IsAdmin
php artisan make:middleware IsMasyarakat
```

---

## Middleware 1: IsAdmin

**File:** `app/Http/Middleware/IsAdmin.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
```

---

## Middleware 2: IsMasyarakat

**File:** `app/Http/Middleware/IsMasyarakat.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsMasyarakat
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!Auth::user()->isMasyarakat()) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
```

---

## Register Middleware

**File:** `bootstrap/app.php`

Update file ini untuk register middleware alias:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'masyarakat' => \App\Http\Middleware\IsMasyarakat::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

---

## Session Configuration

**File:** `config/session.php`

Pastikan session sudah dikonfigurasi dengan baik (default Laravel sudah OK):

```php
'driver' => env('SESSION_DRIVER', 'file'),
'lifetime' => 120,
'expire_on_close' => false,
'encrypt' => false,
'files' => storage_path('framework/sessions'),
'connection' => null,
'table' => 'sessions',
'store' => null,
'lottery' => [2, 100],
'cookie' => env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_').'_session'),
'path' => '/',
'domain' => env('SESSION_DOMAIN'),
'secure' => env('SESSION_SECURE_COOKIE'),
'http_only' => true,
'same_site' => 'lax',
'partitioned' => false,
```

---

## Auth Configuration

**File:** `config/auth.php`

Default Laravel auth sudah cukup, tapi pastikan:

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],

'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
    ],
],
```

---

## Redirect if Authenticated

**File:** `app/Http/Middleware/RedirectIfAuthenticated.php`

Update untuk redirect berdasarkan role:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                // Redirect based on role
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                }
                
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
```

---

## Helper untuk Blade Templates

Tambahkan global helper di blade atau gunakan langsung:

### Cek apakah user adalah admin

```blade
@auth
    @if(Auth::user()->isAdmin())
        <!-- Admin content -->
    @endif
@endauth
```

### Cek apakah user login

```blade
@auth
    <!-- Content untuk user yang sudah login -->
@else
    <!-- Content untuk guest -->
@endauth
```

### Ambil nama user

```blade
@auth
    <p>Halo, {{ Auth::user()->name }}</p>
@endauth
```

---

## Usage Examples in Routes

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

// Public routes (no auth required)
Route::get('/', [BerandaController::class, 'index'])->name('home');

// Auth routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated routes (any logged in user)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/laporan/saya', [LaporanController::class, 'index'])->name('laporan.index');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('laporan', LaporanController::class);
    Route::resource('lokasi', LokasiController::class);
});
```

---

## Testing Authentication

### Manual Testing

```bash
php artisan tinker

# Test user creation
$user = App\Models\User::first();

# Test login
Auth::login($user);

# Check if authenticated
Auth::check(); // should return true

# Get current user
Auth::user();

# Logout
Auth::logout();
```

### Browser Testing

1. Akses `/login`
2. Login dengan kredensial dari seeder
3. Cek apakah redirect ke dashboard (admin) atau home (masyarakat)
4. Test akses ke route yang protected
5. Test logout

---

## Security Best Practices

1. **CSRF Protection** - Laravel sudah include by default di form
```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

2. **Password Hashing** - Sudah otomatis di User model
```php
protected $casts = [
    'password' => 'hashed',
];
```

3. **Rate Limiting** - Tambahkan throttle di routes
```php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute
```

4. **HTTPS** - Di production, paksa HTTPS
```php
// app/Providers/AppServiceProvider.php
public function boot(): void
{
    if ($this->app->environment('production')) {
        \URL::forceScheme('https');
    }
}
```

---

## Troubleshooting

### Session tidak tersimpan
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Set permission storage
chmod -R 775 storage
```

### Login redirect loop
- Cek middleware chain di routes
- Pastikan tidak ada konflik di RedirectIfAuthenticated

### 419 Page Expired (CSRF Token)
- Pastikan @csrf ada di form
- Clear browser cache
- Check session configuration
