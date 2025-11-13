# 📘 PANDUAN BACKEND - PART 1: MIGRATIONS

## Database Migrations untuk Sistem Pengaduan Lingkungan

### Command untuk membuat semua migrations:

```bash
php artisan make:migration create_kategori_table
php artisan make:migration create_area_table
php artisan make:migration create_lokasi_table
php artisan make:migration create_laporan_table
php artisan make:migration create_lampiran_laporan_table
php artisan make:migration create_riwayat_perubahan_status_table
php artisan make:migration update_users_table
```

---

## Migration 1: Kategori Table

**File:** `database/migrations/2024_01_01_000001_create_kategori_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120);
            $table->foreignId('parent_id')->nullable()->constrained('kategori')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
```

---

## Migration 2: Area Table

**File:** `database/migrations/2024_01_01_000002_create_area_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->enum('level', ['kabupaten', 'kecamatan', 'desa', 'kelurahan', 'lain']);
            $table->foreignId('parent_id')->nullable()->constrained('area')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area');
    }
};
```

---

## Migration 3: Lokasi Table

**File:** `database/migrations/2024_01_01_000003_create_lokasi_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('address', 255)->nullable();
            $table->foreignId('area_id')->constrained('area')->onDelete('cascade');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('type', ['tps', 'sungai', 'pasar', 'kawasan', 'lainnya'])->default('lainnya');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi');
    }
};
```

---

## Migration 4: Laporan Table

**File:** `database/migrations/2024_01_01_000004_create_laporan_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique();
            $table->string('title', 150);
            $table->text('description');
            $table->foreignId('category_id')->constrained('kategori')->onDelete('restrict');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->foreignId('reporter_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('reporter_name', 100)->nullable();
            $table->string('reporter_email', 190)->nullable();
            $table->string('reporter_phone', 30)->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->foreignId('location_id')->constrained('lokasi')->onDelete('restrict');
            $table->foreignId('area_id')->constrained('area')->onDelete('restrict');
            $table->string('address', 255)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
```

---

## Migration 5: Lampiran Laporan Table

**File:** `database/migrations/2024_01_01_000005_create_lampiran_laporan_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lampiran_laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('laporan')->onDelete('cascade');
            $table->string('file_path', 255);
            $table->string('file_name', 255);
            $table->string('mime_type', 100);
            $table->unsignedInteger('file_size');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lampiran_laporan');
    }
};
```

---

## Migration 6: Riwayat Status Table

**File:** `database/migrations/2024_01_01_000006_create_riwayat_perubahan_status_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_perubahan_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('laporan')->onDelete('cascade');
            $table->enum('from_status', ['pending', 'diproses', 'selesai', 'ditolak'])->nullable();
            $table->enum('to_status', ['pending', 'diproses', 'selesai', 'ditolak']);
            $table->text('note')->nullable();
            $table->foreignId('changed_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan_status');
    }
};
```

---

## Migration 7: Update Users Table

**File:** `database/migrations/2024_01_01_000007_update_users_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
            $table->enum('role', ['admin', 'masyarakat'])->default('masyarakat')->after('password');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'role', 'status']);
        });
    }
};
```

---

## Menjalankan Migrations

```bash
# Fresh migration (HAPUS SEMUA DATA!)
php artisan migrate:fresh

# Normal migration
php artisan migrate

# Rollback
php artisan migrate:rollback

# Check status
php artisan migrate:status
```
