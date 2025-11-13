# 📘 PANDUAN BACKEND - PART 3: DATABASE SEEDERS

## Seeders untuk Data Awal

### Command untuk membuat seeders:

```bash
php artisan make:seeder UserSeeder
php artisan make:seeder KategoriSeeder
php artisan make:seeder AreaSeeder
php artisan make:seeder LokasiSeeder
```

---

## Seeder 1: UserSeeder

**File:** `database/seeders/UserSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@dairi.go.id',
            'phone' => '0812345678',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Dummy masyarakat users
        User::create([
            'name' => 'Ari Rohyto',
            'email' => 'ari@example.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'masyarakat',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '085678901234',
            'password' => Hash::make('password'),
            'role' => 'masyarakat',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
```

---

## Seeder 2: KategoriSeeder

**File:** `database/seeders/KategoriSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sampah',
                'children' => [
                    'Sampah Ilegal',
                    'Penumpukan Sampah',
                    'Pembakaran Sampah',
                    'TPS Bermasalah',
                ]
            ],
            [
                'name' => 'Lingkungan',
                'children' => [
                    'Pencemaran Air',
                    'Pencemaran Udara',
                    'Pencemaran Tanah',
                    'Kerusakan Hutan',
                    'Penebangan Liar',
                ]
            ],
        ];

        foreach ($categories as $cat) {
            $parent = Kategori::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'is_active' => true,
            ]);

            foreach ($cat['children'] as $child) {
                Kategori::create([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parent->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}
```

---

## Seeder 3: AreaSeeder

**File:** `database/seeders/AreaSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        // Kabupaten Dairi
        $dairi = Area::create([
            'name' => 'Kabupaten Dairi',
            'level' => 'kabupaten',
        ]);

        // Kecamatan-kecamatan di Dairi
        $kecamatans = [
            'Sidikalang' => ['Siempat Rube', 'Pasar Sidikalang', 'Tanjung Beringin'],
            'Parbuluan' => ['Parbuluan I', 'Parbuluan II', 'Parbuluan III'],
            'Silima Pungga-Pungga' => ['Silima I', 'Silima II'],
            'STM Hilir' => ['Salak', 'Tanjung Muda'],
            'Sumbul' => ['Sumbul', 'Gunung Meriah'],
        ];

        foreach ($kecamatans as $kecName => $desas) {
            $kec = Area::create([
                'name' => $kecName,
                'level' => 'kecamatan',
                'parent_id' => $dairi->id,
            ]);

            // Desa/Kelurahan
            foreach ($desas as $desa) {
                Area::create([
                    'name' => $desa,
                    'level' => 'desa',
                    'parent_id' => $kec->id,
                ]);
            }
        }
    }
}
```

---

## Seeder 4: LokasiSeeder

**File:** `database/seeders/LokasiSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        // Get Sidikalang kecamatan
        $sidikalang = Area::where('name', 'Sidikalang')->first();
        
        if (!$sidikalang) {
            $this->command->warn('Area Sidikalang tidak ditemukan. Run AreaSeeder terlebih dahulu.');
            return;
        }

        $lokasis = [
            [
                'name' => 'TPS Sidikalang',
                'description' => 'Tempat Pembuangan Sementara di pusat kota Sidikalang',
                'address' => 'Jl. Sisingamangaraja No. 45',
                'type' => 'tps',
                'latitude' => 2.7458,
                'longitude' => 98.3016,
            ],
            [
                'name' => 'Sungai Lae Pendaroh',
                'description' => 'Sungai yang melintasi kota Sidikalang',
                'address' => 'Area Pasar Sidikalang',
                'type' => 'sungai',
                'latitude' => 2.7421,
                'longitude' => 98.3089,
            ],
            [
                'name' => 'Pasar Sidikalang',
                'description' => 'Pasar utama Kabupaten Dairi',
                'address' => 'Jl. Pasar Sidikalang',
                'type' => 'pasar',
                'latitude' => 2.7438,
                'longitude' => 98.3045,
            ],
            [
                'name' => 'Kawasan Hutan Lindung Lae Pondom',
                'description' => 'Area hutan lindung yang dilindungi',
                'address' => 'Desa Lae Pondom',
                'type' => 'kawasan',
                'latitude' => 2.6890,
                'longitude' => 98.2712,
            ],
        ];

        foreach ($lokasis as $lok) {
            Lokasi::create([
                'name' => $lok['name'],
                'description' => $lok['description'],
                'address' => $lok['address'],
                'area_id' => $sidikalang->id,
                'type' => $lok['type'],
                'latitude' => $lok['latitude'],
                'longitude' => $lok['longitude'],
                'is_active' => true,
            ]);
        }
    }
}
```

---

## Update DatabaseSeeder

**File:** `database/seeders/DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            AreaSeeder::class,
            LokasiSeeder::class,
        ]);
    }
}
```

---

## Menjalankan Seeders

```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=KategoriSeeder

# Fresh migration dengan seeder
php artisan migrate:fresh --seed

# Check data
php artisan tinker
>>> App\Models\User::count()
>>> App\Models\Kategori::count()
>>> App\Models\Area::count()
```

---

## Kredensial Login (Setelah Seeding)

**Admin:**
- Email: `admin@dairi.go.id`
- Password: `password`

**Masyarakat:**
- Email: `ari@example.com`
- Password: `password`

**PENTING:** Ganti password default di production!

---

## Troubleshooting

### Error: Foreign key constraint fails

Pastikan urutan seeding benar:
1. UserSeeder (karena users dibutuhkan oleh tabel lain)
2. KategoriSeeder
3. AreaSeeder
4. LokasiSeeder (butuh Area)

### Error: SQLSTATE[23000]: Integrity constraint violation

```bash
# Hapus semua data dan seed ulang
php artisan migrate:fresh --seed
```
