# 🗄️ MySQL Setup untuk Laragon

## Konfigurasi Database MySQL di Laragon

### 1. Pastikan MySQL Service Running

Di Laragon:
- Klik **Start All** untuk menjalankan Apache & MySQL
- Atau klik kanan icon Laragon → MySQL → Start

Cek status MySQL:
- Icon Laragon akan menampilkan status "MySQL: Running"

---

### 2. Buat Database via phpMyAdmin

#### Cara 1: Menggunakan phpMyAdmin (Recommended)

1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Login dengan:
   - **Username:** `root`
   - **Password:** *(kosong, atau sesuai setting Laragon Anda)*
3. Klik tab **"Databases"**
4. Di bagian **"Create database"**:
   - Database name: `sistem_pengaduan_lingkungan`
   - Collation: `utf8mb4_unicode_ci`
5. Klik **Create**

#### Cara 2: Menggunakan Laragon Terminal

1. Buka Laragon
2. Klik **Menu** → **MySQL** → **MySQL Console**
3. Jalankan perintah SQL:

```sql
CREATE DATABASE sistem_pengaduan_lingkungan 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
```

4. Cek database berhasil dibuat:

```sql
SHOW DATABASES;
```

---

### 3. Konfigurasi File .env

Buka file `.env` di root project Anda, update bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pengaduan_lingkungan
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:**
- `DB_HOST` default Laragon adalah `127.0.0.1`
- `DB_PORT` default MySQL adalah `3306`
- `DB_USERNAME` default adalah `root`
- `DB_PASSWORD` biasanya kosong (default Laragon)

---

### 4. Test Koneksi Database

Jalankan perintah berikut untuk test koneksi:

```bash
php artisan tinker
```

Di dalam tinker, jalankan:

```php
DB::connection()->getPdo();
```

Jika berhasil, akan muncul output seperti:
```
=> PDO {#...}
```

Jika gagal, akan muncul error:
```
SQLSTATE[HY000] [1049] Unknown database 'sistem_pengaduan_lingkungan'
```

Ketik `exit` untuk keluar dari tinker.

---

### 5. Jalankan Migrations

Setelah database terkoneksi, jalankan migrations:

```bash
# Run migrations
php artisan migrate

# Atau dengan fresh (hapus semua data & rebuild)
php artisan migrate:fresh

# Dengan seeder
php artisan migrate:fresh --seed
```

---

## Troubleshooting

### Error: "Access denied for user 'root'@'localhost'"

**Solusi:**
1. Cek password MySQL di Laragon
   - Laragon → Menu → MySQL → Change Password
2. Update `DB_PASSWORD` di file `.env`

### Error: "Unknown database 'sistem_pengaduan_lingkungan'"

**Solusi:**
- Database belum dibuat, ikuti langkah #2 di atas

### Error: "SQLSTATE[HY000] [2002] No connection could be made"

**Solusi:**
1. Pastikan MySQL service running di Laragon
2. Restart Laragon
3. Cek port 3306 tidak dipakai aplikasi lain

### Error: "PDO::__construct(): Argument #1 ($dsn) must be a valid data source name"

**Solusi:**
- Hapus cache config: `php artisan config:clear`
- Restart terminal/command prompt

---

## Default Port Laragon

Jika Anda menggunakan Laragon, berikut default port:

| Service | Port  |
|---------|-------|
| Apache  | 80    |
| MySQL   | 3306  |
| phpMyAdmin | http://localhost/phpmyadmin |

---

## Konfigurasi MySQL di Laragon (Advanced)

### Ganti Password Root MySQL

1. Buka Laragon → Menu → MySQL → Change Password
2. Masukkan password baru
3. Update `DB_PASSWORD` di `.env`

### Akses MySQL via Command Line

```bash
# Buka Laragon Terminal
# Jalankan:
mysql -u root -p

# Masukkan password (jika ada)
# Atau langsung:
mysql -u root
```

### Import Database dari Backup

```bash
# Via command line
mysql -u root sistem_pengaduan_lingkungan < backup.sql

# Via phpMyAdmin
# 1. Buka phpMyAdmin
# 2. Pilih database sistem_pengaduan_lingkungan
# 3. Tab "Import"
# 4. Choose file → pilih backup.sql
# 5. Klik "Go"
```

### Export Database

```bash
# Export semua data
mysqldump -u root sistem_pengaduan_lingkungan > backup.sql

# Export struktur saja (tanpa data)
mysqldump -u root --no-data sistem_pengaduan_lingkungan > structure.sql

# Export data saja (tanpa struktur)
mysqldump -u root --no-create-info sistem_pengaduan_lingkungan > data.sql
```

---

## Tips & Best Practices

### 1. Backup Database Secara Berkala

Buat file batch untuk backup otomatis:

**backup_db.bat:**
```batch
@echo off
set TIMESTAMP=%date:~-4,4%%date:~-10,2%%date:~-7,2%_%time:~0,2%%time:~3,2%%time:~6,2%
mysqldump -u root sistem_pengaduan_lingkungan > backup_%TIMESTAMP%.sql
echo Backup completed: backup_%TIMESTAMP%.sql
pause
```

### 2. Gunakan Migration untuk Perubahan Struktur

Jangan edit database manual via phpMyAdmin. Gunakan migration:

```bash
# Buat migration baru
php artisan make:migration add_column_to_table

# Edit migration file
# Jalankan migration
php artisan migrate
```

### 3. Gunakan Seeder untuk Data Dummy

```bash
# Buat seeder
php artisan make:seeder NamaSeeder

# Run seeder
php artisan db:seed --class=NamaSeeder
```

---

## Verifikasi Setup

Checklist untuk memastikan MySQL tersetup dengan benar:

- [ ] MySQL service running di Laragon
- [ ] Database `sistem_pengaduan_lingkungan` sudah dibuat
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] Test koneksi via `php artisan tinker` berhasil
- [ ] Migration berhasil dijalankan
- [ ] Seeder berhasil dijalankan
- [ ] Bisa akses phpMyAdmin
- [ ] Semua tabel muncul di phpMyAdmin

---

## Referensi

- Laragon Documentation: https://laragon.org/docs/
- Laravel Database: https://laravel.com/docs/database
- MySQL Documentation: https://dev.mysql.com/doc/
