# Implementasi CRUD dan Model Relasi - Modul 12 dan 13

Proyek ini mengimplementasikan praktikum Laravel dari Modul 12 (Database 1 - CRUD) dan Modul 13 (Database 2 - Relasi Model).

## Fitur yang Diimplementasikan

### Modul 12: CRUD Produk
- ✅ Create: Tambah produk baru
- ✅ Read: Tampilkan daftar produk dengan variant yang terkait
- ✅ Update: Edit data produk
- ✅ Delete: Hapus produk
- ✅ Form Validation: Validasi input nama (min 4 char) dan harga (min 1.000.000)
- ✅ Success Messages: Pesan notifikasi setelah operasi CRUD

### Modul 13: Model Relasi dan Variant
- ✅ One-to-Many Relationship: Satu Produk memiliki banyak Variant
- ✅ Eloquent Relations: Implementasi `hasMany()` di Product dan `belongsTo()` di Variant
- ✅ CRUD Variant: Kelola variant untuk setiap produk
- ✅ Session & Auth: Autentikasi pengguna dengan library Auth
- ✅ Templating: Penggunaan Blade template dengan inheritance

## Struktur Proyek

```
app/
├── Http/
│   └── Controllers/
│       ├── ProductController.php    # Controller untuk CRUD Produk
│       └── VariantController.php    # Controller untuk CRUD Variant
├── Models/
│   ├── Product.php                  # Model dengan relasi hasMany
│   ├── Variant.php                  # Model dengan relasi belongsTo
│   └── User.php                     # Model User untuk autentikasi

database/
├── migrations/
│   ├── 2026_05_15_115912_create_products_table.php
│   └── 2026_05_15_115913_create_variants_table.php
└── seeders/
    └── DatabaseSeeder.php           # Seed data awal

resources/
└── views/
    ├── template.blade.php           # Template utama
    ├── login.blade.php              # Halaman login
    ├── products/
    │   ├── index.blade.php          # Daftar produk dengan variant
    │   ├── form.blade.php           # Form tambah/edit produk
    │   └── show.blade.php           # Detail produk
    └── variants/
        ├── index.blade.php          # Daftar variant
        ├── form.blade.php           # Form tambah/edit variant
        └── show.blade.php           # Detail variant

routes/
└── web.php                          # Routing aplikasi
```

## Setup dan Instalasi

### Requirement
- PHP 8.2+
- Composer
- Laravel 12

### Langkah Instalasi

1. Clone repository
```bash
git clone https://github.com/your-username/tugas-5.git
cd tugas-5
```

2. Install dependencies
```bash
composer install
```

3. Buat file .env
```bash
cp .env.example .env
```

4. Generate database (SQLite)
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

5. Generate APP_KEY
```bash
php artisan key:generate
```

6. Jalankan server
```bash
php artisan serve
```

7. Akses aplikasi di `http://127.0.0.1:8000`

## Login Credentials

- **Email**: admin@example.com
- **Password**: password

## Endpoint Aplikasi

### Authentication
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /logout` - Logout

### Product (Protected by Auth Middleware)
- `GET /products` - Daftar produk dengan variant
- `GET /products/create` - Form tambah produk
- `POST /products` - Simpan produk baru
- `GET /products/{product}/edit` - Form edit produk
- `PUT /products/{product}` - Update produk
- `DELETE /products/{product}` - Hapus produk

### Variant (Protected by Auth Middleware)
- `GET /variants` - Daftar variant
- `GET /variants/create` - Form tambah variant
- `POST /variants` - Simpan variant baru
- `GET /variants/{variant}/edit` - Form edit variant
- `PUT /variants/{variant}` - Update variant
- `DELETE /variants/{variant}` - Hapus variant

## Database Schema

### Table: products
```sql
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Table: variants
```sql
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

## Validasi Input

### Produk
- **Name**: Required, minimum 4 karakter
- **Price**: Required, integer, minimum 1.000.000

### Variant
- **Name**: Required, minimum 4 karakter
- **Description**: Required, minimum 10 karakter
- **Processor**: Required, minimum 3 karakter
- **Memory**: Required, minimum 2 karakter
- **Storage**: Required, minimum 2 karakter
- **Product**: Required, harus valid product_id

## Fitur Keamanan

1. **CSRF Protection**: Semua form dilindungi dengan CSRF token
2. **SQL Injection Prevention**: Menggunakan prepared statements melalui Eloquent ORM
3. **Password Hashing**: Password di-hash dengan bcrypt
4. **Authorization**: Middleware auth melindungi resource dari akses non-authenticated users
5. **Mass Assignment Protection**: Menggunakan `$fillable` pada models

## Testing Manual

### Skenario 1: CRUD Produk
1. Login dengan admin@example.com / password
2. Klik "Tambah Produk"
3. Isi data produk (nama min 4 char, harga min 1.000.000)
4. Klik Simpan
5. Edit produk dengan klik tombol Edit
6. Hapus produk dengan klik tombol Hapus

### Skenario 2: Relasi One-to-Many
1. Setelah login, lihat daftar produk
2. Perhatikan kolom "Variant" yang menampilkan variant terkait
3. Klik "Kelola Variant"
4. Tambah variant baru dan pilih produk dari dropdown
5. Variant akan muncul di daftar produk

### Skenario 3: Validasi Form
1. Login, buka form tambah produk
2. Isi nama dengan kurang dari 4 karakter
3. Isi harga dengan kurang dari 1.000.000
4. Klik Simpan
5. Error message akan ditampilkan dengan validasi

## Dokumentasi Modul

Lihat folder `docs/` untuk screenshot output dan penjelasan lebih detail.

## Catatan Penting

- Aplikasi menggunakan SQLite sebagai database (file `database/database.sqlite`)
- Session disimpan di file system (folder `storage/framework/sessions`)
- Autentikasi menggunakan Laravel Auth built-in
- Blade templating dengan layout inheritance untuk reusability

---

**Dibuat untuk memenuhi tugas Praktikum Pemrograman Web - Modul 12 & 13**
