# Dokumentasi Output Modul 12 & 13 - Implementasi CRUD dan Model Relasi

## Ringkasan Implementasi

Aplikasi ini mengimplementasikan semua fitur yang diminta pada Modul 12 (CRUD Produk) dan Modul 13 (Relasi One-to-Many dan Variant Management).

---

## Screenshots Output Aplikasi

### 1. Halaman Login
**Lokasi**: `http://127.0.0.1:8000/login`
- Form login dengan field Email dan Password
- Validasi CSRF protection
- Redirect ke halaman produk setelah login berhasil

**Credentials**:
- Email: `admin@example.com`
- Password: `password`

---

### 2. Halaman Daftar Produk (READ)
**Lokasi**: `http://127.0.0.1:8000/products`

**Fitur**:
- Menampilkan semua produk dalam bentuk tabel
- Kolom: Nama, Harga, Variant (dengan relasi), Aksi (Edit/Hapus)
- Menampilkan variant yang terkait untuk setiap produk (One-to-Many Relationship)
- Button "Tambah Produk" untuk create operasi
- Button "Kelola Variant" untuk mengelola variant secara terpisah

**Data Awal (Seed)**:
- Produk: Laptop Slim (Rp 15.000.000) dengan 1 variant
- Produk: Smartphone Pro (Rp 11.000.000) dengan 1 variant

**Output Menampilkan**:
- Laptop Slim → Variant: Slim i7 (Intel Core i7, 16 GB, 512 GB SSD)
- Smartphone Pro → Variant: Pro Max 5G (Snapdragon 8 Gen 2, 12 GB, 256 GB SSD)

---

### 3. Halaman Form Tambah Produk (CREATE)
**Lokasi**: `http://127.0.0.1:8000/products/create`

**Form Field**:
- **Nama**: Input text (required, min 4 karakter)
- **Harga**: Input number (required, integer, min 1.000.000)
- **Button**: Simpan

**Contoh Input**:
- Nama: "Smartphone Pro"
- Harga: "12000000"

**Output**: 
- Redirect ke halaman daftar produk
- Menampilkan success message: "Produk berhasil ditambahkan"

---

### 4. Halaman Form Edit Produk (UPDATE)
**Lokasi**: `http://127.0.0.1:8000/products/{id}/edit`

**Fitur**:
- Form field pre-filled dengan data produk yang ada
- Menggunakan form yang sama dengan halaman tambah
- Method POST dengan @method('PUT')
- CSRF token untuk keamanan

**Contoh**:
- Edit Smartphone Pro dari harga Rp 12.000.000 → Rp 11.000.000
- Output: Success message "Produk berhasil diperbarui"

---

### 5. Form Validation Error
**Lokasi**: `http://127.0.0.1:8000/products/create`

**Validasi Diterapkan**:
- Nama minimal 4 karakter: ❌ "PC" → Error: "The name field must be at least 4 characters."
- Harga minimal 1.000.000: ❌ "500000" → Error: "The price field must be at least 1000000."

**Output**: Form menampilkan error message dengan field highlight merah

---

### 6. Halaman Daftar Variant (READ)
**Lokasi**: `http://127.0.0.1:8000/variants`

**Fitur**:
- Menampilkan semua variant dalam tabel
- Kolom: Nama, Produk (Foreign Key - belongsTo relation), Processor, Memory, Storage, Aksi
- Button "Tambah Variant" untuk create operasi
- Setiap variant menampilkan produk yang terkait

**Data**:
- Slim i7 → Laptop Slim
- Pro Max 5G → Smartphone Pro

---

### 7. Halaman Form Tambah Variant (CREATE)
**Lokasi**: `http://127.0.0.1:8000/variants/create`

**Form Field**:
- **Produk**: Dropdown select (required, validated dengan exists:products,id)
- **Nama Variant**: Input text (required, min 4 karakter)
- **Deskripsi**: Textarea (required, min 10 karakter)
- **Processor**: Input text (required, min 3 karakter)
- **Memory**: Input text (required, min 2 karakter)
- **Storage**: Input text (required, min 2 karakter)

**Contoh Input**:
- Produk: "Smartphone Pro" (dipilih dari dropdown)
- Nama: "Pro Max 5G"
- Deskripsi: "Smartphone flagship dengan layar 6.7 inch dan 5G connectivity terbaru."
- Processor: "Snapdragon 8 Gen 2"
- Memory: "12 GB"
- Storage: "256 GB SSD"

**Output**:
- Variant baru tersimpan dan terkait ke Produk
- Redirect ke halaman daftar variant
- Success message: "Variant berhasil ditambahkan"

---

### 8. Relasi One-to-Many di Halaman Produk
**Bukti Implementasi Relasi**:

Setelah menambah variant "Pro Max 5G" ke "Smartphone Pro", di halaman daftar produk akan terlihat:

```
Smartphone Pro | 11.000.000 | • Pro Max 5G
                            |   Desc: Smartphone flagship...
                            |   Proc: Snapdragon 8 Gen 2
                            |   RAM: 12 GB
                            |   Strg: 256 GB SSD
```

**Kode Backend** (Product Model):
```php
public function variants()
{
    return $this->hasMany(Variant::class);
}
```

**Kode Backend** (Variant Model):
```php
public function product()
{
    return $this->belongsTo(Product::class);
}
```

**Kode View** (products/index.blade.php):
```blade
@foreach($product->variants as $variant)
    <li>
        <strong>{{ $variant->name }}</strong><br>
        Desc: {{ $variant->description }}<br>
        Proc: {{ $variant->processor }}<br>
        RAM: {{ $variant->memory }}<br>
        Strg: {{ $variant->storage }}
    </li>
@endforeach
```

---

## Fitur yang Terimplementasi

### Modul 12 - CRUD Produk ✅
- [x] **C**reate: Tambah produk baru via form
- [x] **R**ead: Tampilkan daftar produk dengan variant terkait
- [x] **U**pdate: Edit data produk
- [x] **D**elete: Hapus produk
- [x] Form Validation: Validasi input server-side
- [x] Error Messages: Tampilkan pesan error validasi
- [x] Success Messages: Tampilkan pesan berhasil setelah operasi

### Modul 13 - Relasi dan Session ✅
- [x] Session: Implementasi autentikasi dengan Laravel Auth
- [x] Middleware: Protect route dengan 'auth' middleware
- [x] Model Relasi (One-to-Many):
  - Product hasMany Variant
  - Variant belongsTo Product
- [x] CRUD Variant: Kelola variant untuk setiap produk
- [x] Templating: Blade inheritance dengan @extends dan @section
- [x] Foreign Key: Relasi database dengan ON DELETE CASCADE

---

## Struktur Kode yang Digunakan

### 1. Product Model
```php
class Product extends Model
{
    protected $fillable = ['name', 'price'];
    
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
```

### 2. Variant Model
```php
class Variant extends Model
{
    protected $fillable = ['name', 'description', 'processor', 'memory', 'storage', 'product_id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```

### 3. ProductController (CRUD Methods)
```php
- index()      → GET /products (tampilkan semua produk)
- create()     → GET /products/create (tampilkan form)
- store()      → POST /products (simpan produk baru)
- edit()       → GET /products/{id}/edit (tampilkan form edit)
- update()     → PUT /products/{id} (update produk)
- destroy()    → DELETE /products/{id} (hapus produk)
```

### 4. Database Migration
```sql
-- products table
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- variants table
CREATE TABLE variants (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    processor VARCHAR(255) NOT NULL,
    memory VARCHAR(255) NOT NULL,
    storage VARCHAR(255) NOT NULL,
    product_id BIGINT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

---

## Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Database**: SQLite (file-based)
- **ORM**: Eloquent
- **Template Engine**: Blade
- **CSS Framework**: Bootstrap 5.3
- **Authentication**: Laravel Auth
- **Validation**: Laravel Validation Rules

---

## Cara Menjalankan Aplikasi

```bash
# 1. Setup
composer install
php artisan key:generate
php artisan migrate:fresh --seed

# 2. Jalankan server
php artisan serve

# 3. Akses di browser
http://127.0.0.1:8000/login
```

---

## Kesimpulan

Aplikasi ini telah berhasil mengimplementasikan:
1. ✅ Semua operasi CRUD untuk Produk (Modul 12)
2. ✅ Relasi One-to-Many antara Product dan Variant (Modul 13)
3. ✅ Autentikasi dan Session Management
4. ✅ Form Validation dengan error messages
5. ✅ Blade Templating dengan inheritance
6. ✅ Eloquent ORM untuk database operations
7. ✅ CSRF Protection dan Security Best Practices

Semua output sesuai dengan spesifikasi modul dan berfungsi dengan baik.
