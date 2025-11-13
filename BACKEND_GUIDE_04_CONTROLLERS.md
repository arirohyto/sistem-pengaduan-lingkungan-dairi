# 📘 PANDUAN BACKEND - PART 4: CONTROLLERS

## Controllers untuk Handle Business Logic

### Command untuk membuat controllers:

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

---

## 1. Auth Controllers

### LoginController

**File:** `app/Http/Controllers/Auth/LoginController.php`

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
}
```

---

### RegisterController

**File:** `app/Http/Controllers/Auth/RegisterController.php`

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'masyarakat',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }
}
```

---

### LogoutController

**File:** `app/Http/Controllers/Auth/LogoutController.php`

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
```

---

## 2. Public Controllers

### BerandaController

**File:** `app/Http/Controllers/BerandaController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class BerandaController extends Controller
{
    public function index()
    {
        $stats = [
            'total_laporan' => Laporan::count(),
            'pending' => Laporan::pending()->count(),
            'diproses' => Laporan::diproses()->count(),
            'selesai' => Laporan::selesai()->count(),
        ];

        return view('pages.beranda', compact('stats'));
    }
}
```

---

### LaporanController (Public)

**File:** `app/Http/Controllers/LaporanController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\LampiranLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function create()
    {
        $categories = Kategori::active()->with('children')->whereNull('parent_id')->get();
        $areas = Area::kecamatan()->get();
        $lokasis = Lokasi::active()->with('area')->get();

        return view('pages.buatlaporan', compact('categories', 'areas', 'lokasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:kategori,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string|min:10',
            'location_id' => 'required|exists:lokasi,id',
            'area_id' => 'required|exists:area,id',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_anonymous' => 'boolean',
            'reporter_name' => 'nullable|string|max:100',
            'reporter_email' => 'nullable|email',
            'reporter_phone' => 'nullable|string|max:30',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048', // 2MB
        ]);

        DB::beginTransaction();
        try {
            $laporan = Laporan::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'location_id' => $validated['location_id'],
                'area_id' => $validated['area_id'],
                'address' => $validated['address'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'status' => 'pending',
                'reporter_id' => Auth::check() ? Auth::id() : null,
                'is_anonymous' => $request->boolean('is_anonymous'),
                'reporter_name' => $validated['reporter_name'] ?? Auth::user()?->name,
                'reporter_email' => $validated['reporter_email'] ?? Auth::user()?->email,
                'reporter_phone' => $validated['reporter_phone'] ?? Auth::user()?->phone,
            ]);

            // Upload photos
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('laporan/' . $laporan->code, 'public');

                    LampiranLaporan::create([
                        'report_id' => $laporan->id,
                        'file_path' => $path,
                        'file_name' => $photo->getClientOriginalName(),
                        'mime_type' => $photo->getMimeType(),
                        'file_size' => $photo->getSize(),
                        'uploaded_by' => Auth::id(),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('laporan.show', $laporan->code)
                ->with('success', "Laporan berhasil dibuat! Nomor: {$laporan->code}");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $laporan = Laporan::with(['category', 'location', 'area'])
            ->when(Auth::check(), function ($q) {
                $q->where('reporter_id', Auth::id());
            })
            ->latest()
            ->paginate(20);

        return view('pages.laporansaya', compact('laporan'));
    }

    public function show($code)
    {
        $laporan = Laporan::with(['category', 'location', 'area', 'lampiran', 'riwayatStatus.user'])
            ->where('code', $code)
            ->firstOrFail();

        // Check authorization
        if (!Auth::check() || (!Auth::user()->isAdmin() && $laporan->reporter_id !== Auth::id())) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('pages.detaillaporan', compact('laporan'));
    }
}
```

---

## 3. Admin Controllers

### DashboardController

**File:** `app/Http/Controllers/Admin/DashboardController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_laporan' => Laporan::count(),
            'pending' => Laporan::pending()->count(),
            'diproses' => Laporan::diproses()->count(),
            'selesai' => Laporan::selesai()->count(),
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
            'total_users' => User::masyarakat()->count(),
        ];

        // Recent reports
        $recentReports = Laporan::with(['category', 'location', 'reporter'])
            ->latest()
            ->limit(10)
            ->get();

        // Reports by status (for chart)
        $reportsByStatus = Laporan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Reports by category
        $reportsByCategory = Laporan::select('category_id', DB::raw('count(*) as total'))
            ->with('category')
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentReports',
            'reportsByStatus',
            'reportsByCategory'
        ));
    }
}
```

---

### LaporanController (Admin)

**File:** `app/Http/Controllers/Admin/LaporanController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\RiwayatPerubahanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with(['category', 'location', 'area', 'reporter']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('code', 'like', "%{$request->search}%")
                    ->orWhere('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $laporan = $query->latest()->paginate(20);

        return view('admin.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::with([
            'category',
            'location',
            'area',
            'reporter',
            'lampiran',
            'riwayatStatus.user'
        ])->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'note' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $oldStatus = $laporan->status;

        // Update status
        $laporan->update(['status' => $validated['status']]);

        // Record history
        RiwayatPerubahanStatus::create([
            'report_id' => $laporan->id,
            'from_status' => $oldStatus,
            'to_status' => $validated['status'],
            'note' => $validated['note'],
            'changed_by' => Auth::id(),
            'created_at' => now(),
        ]);

        return back()->with('success', 'Status laporan berhasil diubah!');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete(); // Soft delete

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}
```

---

### LokasiController (Admin)

**File:** `app/Http/Controllers/Admin/LokasiController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::with('area')->latest()->paginate(20);
        $areas = Area::kecamatan()->get();

        return view('admin.lokasi.index', compact('lokasis', 'areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'area_id' => 'required|exists:area,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:tps,sungai,pasar,kawasan,lainnya',
            'is_active' => 'boolean',
        ]);

        Lokasi::create($validated);

        return back()->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'area_id' => 'required|exists:area,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:tps,sungai,pasar,kawasan,lainnya',
            'is_active' => 'boolean',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($validated);

        return back()->with('success', 'Lokasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete(); // Soft delete

        return back()->with('success', 'Lokasi berhasil dihapus!');
    }
}
```

---

## Controller Structure Summary

```
app/Http/Controllers/
├── Auth/
│   ├── LoginController.php       → Login logic
│   ├── RegisterController.php    → Registration logic
│   └── LogoutController.php      → Logout logic
│
├── BerandaController.php         → Homepage (public)
├── LaporanController.php         → Laporan CRUD (public/user)
│
└── Admin/
    ├── DashboardController.php   → Admin dashboard & stats
    ├── LaporanController.php     → Manage all reports
    └── LokasiController.php      → Manage locations
```
