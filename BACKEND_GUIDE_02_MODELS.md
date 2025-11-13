# 📘 PANDUAN BACKEND - PART 2: MODELS & RELATIONSHIPS

## Eloquent Models untuk Sistem Pengaduan Lingkungan

### Command untuk membuat semua models:

```bash
php artisan make:model Kategori
php artisan make:model Area
php artisan make:model Lokasi
php artisan make:model Laporan
php artisan make:model LampiranLaporan
php artisan make:model RiwayatPerubahanStatus
```

---

## Model 1: Kategori

**File:** `app/Models/Kategori.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['name', 'slug', 'parent_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Kategori::class, 'parent_id');
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
```

---

## Model 2: Area

**File:** `app/Models/Area.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $table = 'area';

    protected $fillable = ['name', 'level', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Area::class, 'parent_id');
    }

    public function lokasi(): HasMany
    {
        return $this->hasMany(Lokasi::class, 'area_id');
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'area_id');
    }

    public function scopeByLevel($query, string $level)
    {
        return $query->where('level', $level);
    }

    public function scopeKabupaten($query)
    {
        return $query->where('level', 'kabupaten');
    }

    public function scopeKecamatan($query)
    {
        return $query->where('level', 'kecamatan');
    }
}
```

---

## Model 3: Lokasi

**File:** `app/Models/Lokasi.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use SoftDeletes;

    protected $table = 'lokasi';

    protected $fillable = [
        'name', 'description', 'address', 'area_id', 
        'latitude', 'longitude', 'type', 'is_active'
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'location_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function getFullAddressAttribute(): string
    {
        return implode(', ', array_filter([
            $this->address,
            $this->area?->name,
        ]));
    }
}
```

---

## Model 4: Laporan

**File:** `app/Models/Laporan.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes;

    protected $table = 'laporan';

    protected $fillable = [
        'code', 'title', 'description', 'category_id', 'status',
        'reporter_id', 'reporter_name', 'reporter_email', 'reporter_phone',
        'is_anonymous', 'location_id', 'area_id', 'address',
        'latitude', 'longitude',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($laporan) {
            if (empty($laporan->code)) {
                $laporan->code = static::generateCode();
            }
        });
    }

    public static function generateCode(): string
    {
        $date = now()->format('Ymd');
        $count = static::whereDate('created_at', now())->count() + 1;
        return 'DLH-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'location_id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranLaporan::class, 'report_id');
    }

    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatPerubahanStatus::class, 'report_id')
            ->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->status,
        };
    }

    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'pending' => [
                'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
                'text' => 'text-yellow-800 dark:text-yellow-400'
            ],
            'diproses' => [
                'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                'text' => 'text-blue-800 dark:text-blue-400'
            ],
            'selesai' => [
                'bg' => 'bg-green-100 dark:bg-green-900/30',
                'text' => 'text-green-800 dark:text-green-400'
            ],
            'ditolak' => [
                'bg' => 'bg-red-100 dark:bg-red-900/30',
                'text' => 'text-red-800 dark:text-red-400'
            ],
            default => [
                'bg' => 'bg-gray-100',
                'text' => 'text-gray-800'
            ],
        };
    }
}
```

---

## Model 5: LampiranLaporan

**File:** `app/Models/LampiranLaporan.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LampiranLaporan extends Model
{
    protected $table = 'lampiran_laporan';

    protected $fillable = [
        'report_id', 'file_path', 'file_name', 
        'mime_type', 'file_size', 'uploaded_by'
    ];

    protected $casts = ['file_size' => 'integer'];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function isImage(): bool
    {
        return Str::startsWith($this->mime_type, 'image/');
    }
}
```

---

## Model 6: RiwayatPerubahanStatus

**File:** `app/Models/RiwayatPerubahanStatus.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPerubahanStatus extends Model
{
    protected $table = 'riwayat_perubahan_status';

    public $timestamps = false;

    protected $fillable = [
        'report_id', 'from_status', 'to_status', 
        'note', 'changed_by', 'created_at'
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function getFromStatusLabelAttribute(): ?string
    {
        if (!$this->from_status) return null;

        return match($this->from_status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->from_status,
        };
    }

    public function getToStatusLabelAttribute(): string
    {
        return match($this->to_status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->to_status,
        };
    }
}
```

---

## Model 7: Update User Model

**File:** `app/Models/User.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'status'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'reporter_id');
    }

    public function lampiranUploaded(): HasMany
    {
        return $this->hasMany(LampiranLaporan::class, 'uploaded_by');
    }

    public function riwayatPerubahan(): HasMany
    {
        return $this->hasMany(RiwayatPerubahanStatus::class, 'changed_by');
    }

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeMasyarakat($query)
    {
        return $query->where('role', 'masyarakat');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
```

---

## Diagram Relationships

```
User
├── hasMany → Laporan (reporter_id)
├── hasMany → LampiranLaporan (uploaded_by)
└── hasMany → RiwayatPerubahanStatus (changed_by)

Kategori (hierarchical)
├── belongsTo → Kategori (parent)
├── hasMany → Kategori (children)
└── hasMany → Laporan

Area (hierarchical)
├── belongsTo → Area (parent)
├── hasMany → Area (children)
├── hasMany → Lokasi
└── hasMany → Laporan

Lokasi
├── belongsTo → Area
└── hasMany → Laporan

Laporan
├── belongsTo → Kategori
├── belongsTo → User (reporter)
├── belongsTo → Lokasi
├── belongsTo → Area
├── hasMany → LampiranLaporan
└── hasMany → RiwayatPerubahanStatus

LampiranLaporan
├── belongsTo → Laporan
└── belongsTo → User (uploader)

RiwayatPerubahanStatus
├── belongsTo → Laporan
└── belongsTo → User (changed_by)
```
