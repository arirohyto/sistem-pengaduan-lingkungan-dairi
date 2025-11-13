# 📘 PANDUAN BACKEND - PART 7: FORM VALIDATION

## Form Request Validation Classes

### Command untuk membuat Form Requests:

```bash
php artisan make:request LaporanRequest
php artisan make:request LokasiRequest
php artisan make:request LoginRequest
php artisan make:request RegisterRequest
```

---

## Form Request 1: LoginRequest

**File:** `app/Http/Requests/LoginRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Everyone can attempt to login
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'remember' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
    }
}
```

---

## Form Request 2: RegisterRequest

**File:** `app/Http/Requests/RegisterRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
```

---

## Form Request 3: LaporanRequest

**File:** `app/Http/Requests/LaporanRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // Only authenticated users
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:kategori,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string|min:10',
            'location_id' => 'required|exists:lokasi,id',
            'area_id' => 'required|exists:area,id',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_anonymous' => 'nullable|boolean',
            'reporter_name' => 'required_if:is_anonymous,true|string|max:100',
            'reporter_email' => 'nullable|email|max:190',
            'reporter_phone' => 'nullable|string|max:30',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048', // 2MB per file
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori laporan wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'title.required' => 'Judul laporan wajib diisi.',
            'title.max' => 'Judul maksimal 150 karakter.',
            'description.required' => 'Deskripsi laporan wajib diisi.',
            'description.min' => 'Deskripsi minimal 10 karakter.',
            'location_id.required' => 'Lokasi kejadian wajib dipilih.',
            'location_id.exists' => 'Lokasi yang dipilih tidak valid.',
            'area_id.required' => 'Area/wilayah wajib dipilih.',
            'area_id.exists' => 'Area yang dipilih tidak valid.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
            'reporter_name.required_if' => 'Nama pelapor wajib diisi untuk laporan anonim.',
            'photos.max' => 'Maksimal 5 foto dapat diunggah.',
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'kategori',
            'title' => 'judul',
            'description' => 'deskripsi',
            'location_id' => 'lokasi',
            'area_id' => 'area',
            'photos.*' => 'foto',
        ];
    }
}
```

---

## Form Request 4: LokasiRequest

**File:** `app/Http/Requests/LokasiRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LokasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'area_id' => 'required|exists:area,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'type' => 'required|in:tps,sungai,pasar,kawasan,lainnya',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lokasi wajib diisi.',
            'name.max' => 'Nama lokasi maksimal 150 karakter.',
            'area_id.required' => 'Area/wilayah wajib dipilih.',
            'area_id.exists' => 'Area yang dipilih tidak valid.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
            'type.required' => 'Tipe lokasi wajib dipilih.',
            'type.in' => 'Tipe lokasi tidak valid.',
        ];
    }
}
```

---

## Using Form Requests in Controllers

### Before (Manual Validation):

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:150',
        'description' => 'required|string|min:10',
        // ... more rules
    ]);
    
    // Process data
}
```

### After (Form Request):

```php
use App\Http\Requests\LaporanRequest;

public function store(LaporanRequest $request)
{
    // Validation already done automatically!
    $validated = $request->validated();
    
    // Process data
    Laporan::create($validated);
}
```

---

## Custom Validation Rules

### Create Custom Rule:

```bash
php artisan make:rule PhoneNumber
```

**File:** `app/Rules/PhoneNumber.php`

```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Indonesian phone number pattern
        if (!preg_match('/^(\+62|62|0)[0-9]{9,12}$/', $value)) {
            $fail('Format nomor telepon tidak valid.');
        }
    }
}
```

**Usage:**

```php
use App\Rules\PhoneNumber;

public function rules(): array
{
    return [
        'phone' => ['required', new PhoneNumber],
    ];
}
```

---

## Displaying Validation Errors in Blade

### Display All Errors:

```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

### Display Specific Field Error:

```blade
<input type="text" name="title" value="{{ old('title') }}">
@error('title')
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
```

### Keep Old Input After Validation Fails:

```blade
<input type="text" name="title" value="{{ old('title') }}">
<textarea name="description">{{ old('description') }}</textarea>
<input type="checkbox" name="is_anonymous" {{ old('is_anonymous') ? 'checked' : '' }}>
```

---

## Conditional Validation

### Sometimes Validate:

```php
public function rules(): array
{
    return [
        'email' => 'sometimes|required|email',
        'password' => 'sometimes|required|min:6',
    ];
}
```

### Required If Another Field Has Value:

```php
public function rules(): array
{
    return [
        'is_anonymous' => 'boolean',
        'reporter_name' => 'required_if:is_anonymous,true',
        'reporter_email' => 'required_unless:is_anonymous,true',
    ];
}
```

### Required Without Another Field:

```php
public function rules(): array
{
    return [
        'reporter_id' => 'nullable|exists:users,id',
        'reporter_name' => 'required_without:reporter_id',
    ];
}
```

---

## File Upload Validation

```php
public function rules(): array
{
    return [
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB
        'document' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB
        'photos' => 'array|max:5',
        'photos.*' => 'image|max:2048',
    ];
}
```

---

## Array Validation

```php
public function rules(): array
{
    return [
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
    ];
}
```

---

## Validation Rule Reference (Common)

```php
'field' => 'required'                    // Wajib diisi
'field' => 'nullable'                    // Boleh null
'field' => 'string'                      // Harus string
'field' => 'integer'                     // Harus integer
'field' => 'numeric'                     // Harus numeric (int/float)
'field' => 'boolean'                     // Harus boolean
'field' => 'email'                       // Format email valid
'field' => 'url'                         // Format URL valid
'field' => 'date'                        // Format tanggal valid
'field' => 'min:3'                       // Minimal 3 (string/array/numeric)
'field' => 'max:255'                     // Maksimal 255
'field' => 'between:1,100'               // Antara 1-100
'field' => 'in:a,b,c'                    // Harus salah satu dari: a, b, c
'field' => 'unique:users,email'          // Unique di table users kolom email
'field' => 'exists:users,id'             // Harus ada di table users kolom id
'field' => 'confirmed'                   // Harus sama dengan field_confirmation
'field' => 'regex:/^[a-zA-Z]+$/'        // Regex pattern
'field' => 'image'                       // Harus file gambar
'field' => 'mimes:jpg,png,pdf'          // Tipe file tertentu
'field' => 'dimensions:min_width=100'    // Dimensi gambar
'field' => 'after:2024-01-01'           // Tanggal setelah
'field' => 'before:2024-12-31'          // Tanggal sebelum
'field' => 'required_if:other,value'    // Required jika field other = value
'field' => 'required_with:other'        // Required jika field other ada
```

---

## Testing Validation

```bash
php artisan tinker

# Test validation manually
$validator = Validator::make(
    ['email' => 'invalid-email'],
    ['email' => 'required|email']
);

$validator->fails(); // true
$validator->errors()->first('email'); // "The email must be a valid email address."
```
