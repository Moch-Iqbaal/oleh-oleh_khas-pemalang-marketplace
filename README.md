# UMKM Shop — E-Commerce UMKM Lokal

Aplikasi web e-commerce sederhana untuk UMKM lokal, dibuat dengan **Laravel** dan **MySQL** memakai pola **MVC**.
Tugas UAS Web Application Development (WAD04), Universitas Cakrawala.

## Fitur

- Registrasi, login, logout (session di-regenerate setelah login, login dibatasi 5 percobaan/menit)
- Hak akses berbasis role: **admin**, **staff**, **customer** (middleware `role:`)
- CRUD kategori dan produk (validasi FormRequest, upload gambar, slug unik, pencarian, pagination)
- Toko: daftar produk per kategori, pencarian, detail produk
- Keranjang belanja berbasis session
- Checkout di dalam `DB::transaction` dengan `lockForUpdate` (cek stok aman dari race condition), kode invoice, snapshot harga, pengurangan stok
- Riwayat pesanan customer, daftar pesanan + ubah status untuk admin/staff
- Dashboard admin: total produk, customer, pesanan, pesanan pending, pendapatan, stok menipis
- Keamanan: CSRF di semua form, escaping Blade `{{ }}`, query Eloquent (parameter binding), policy pesanan, halaman error 403/404/419/500, pesan validasi Bahasa Indonesia

## Hak Akses

| Fitur | Admin | Staff | Customer | Tamu |
|---|:-:|:-:|:-:|:-:|
| Lihat produk | ✅ | ✅ | ✅ | ✅ |
| Keranjang & checkout | ❌ | ❌ | ✅ | ❌ |
| Riwayat pesanan sendiri | — | — | ✅ | ❌ |
| Dashboard admin | ✅ | ✅ | ❌ | ❌ |
| CRUD kategori & produk | ✅ | ✅ | ❌ | ❌ |
| Lihat & ubah status pesanan | ✅ | ✅ | ❌ | ❌ |
| Kelola role user | ✅ | ❌ | ❌ | ❌ |

## Akun Login (data seeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@umkm.test | password123 |
| Staff | staff@umkm.test | password123 |
| Customer | customer@umkm.test | password123 |

## Instalasi Lokal

Kebutuhan: PHP 8.2+, Composer, MySQL 8.

```bash
git clone <url-repo> umkm-shop
cd umkm-shop
composer install
cp .env.example .env
php artisan key:generate
```

Buat database `umkm_shop` di MySQL, lalu sesuaikan `DB_USERNAME` dan `DB_PASSWORD` di `.env`.

```bash
php artisan migrate --seed      # buat tabel + data dummy
php artisan storage:link        # supaya gambar produk bisa diakses
php artisan serve
```

Buka http://127.0.0.1:8000.

Alternatif tanpa migration: import `database/umkm_shop.sql` ke database `umkm_shop`.

```bash
mysql -u root -p umkm_shop < database/umkm_shop.sql
```

Menjalankan test (memakai SQLite in-memory, tidak menyentuh database MySQL):

```bash
php artisan test
```

## Struktur Database

- `users` (id, name, email, password, role)
- `categories` (id, name, slug)
- `products` (id, category_id → categories, name, slug, description, price, stock, image)
- `transactions` (id, user_id → users, invoice_code, total, status)
- `transaction_items` (id, transaction_id → transactions, product_id → products, qty, price = snapshot harga)

## Struktur MVC

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/LoginController.php, RegisterController.php
│   │   ├── Admin/DashboardController.php, CategoryController.php,
│   │   │        ProductController.php, OrderController.php, UserController.php
│   │   ├── ShopController.php       # daftar & detail produk
│   │   ├── CartController.php       # keranjang (session)
│   │   ├── CheckoutController.php   # proses checkout
│   │   └── OrderController.php      # riwayat pesanan customer
│   ├── Middleware/EnsureRole.php    # middleware role:admin,staff
│   └── Requests/CategoryRequest.php, ProductRequest.php
├── Models/User.php, Category.php, Product.php, Transaction.php, TransactionItem.php
└── Policies/TransactionPolicy.php
resources/views/                    # View (Blade)
├── layouts/ (app, admin)
├── auth/, shop/, orders/, admin/, errors/
routes/web.php                       # Routing
database/migrations, seeders, umkm_shop.sql
tests/Feature/                       # AuthTest, RoleAccessTest, CheckoutTest
```

Alur request: **Route** (`routes/web.php`) → **Middleware** (auth, role) → **Controller** → **Model** (Eloquent ke MySQL) → **View** (Blade) → response HTML.
