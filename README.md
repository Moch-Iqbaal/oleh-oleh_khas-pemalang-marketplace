# Oleh-Oleh Pemalang — Marketplace UMKM Khas Pemalang

> Bawa pulang rasa Pemalang, ke mana pun kamu pergi.

Marketplace oleh-oleh tempat banyak UMKM Kabupaten Pemalang berjualan: camilan dan kerupuk, kopi dan teh, batik, sampai paket hampers.
Ditujukan untuk perantau, wisatawan, dan warga lokal yang ingin mengirim hadiah dari Pemalang.

Dibuat dengan **Laravel** dan **MySQL** dengan pola **MVC**, untuk tugas UAS Web Application Development (WAD04), Universitas Cakrawala.

## Fitur

- **Auth**: registrasi pembeli atau **daftar sebagai penjual** (sekaligus membuat toko yang menunggu verifikasi), login, logout. Session di-regenerate setelah login, login dibatasi 5 percobaan/menit
- **Role**: admin, staff (moderator platform), seller (pemilik toko), customer. Role dari form registrasi di-whitelist (hanya `customer` atau `seller`)
- **Toko UMKM**: tiap seller punya satu toko (`stores`), admin memverifikasi toko. Produk toko yang belum diverifikasi tidak tampil
- **Produk**: CRUD dengan FormRequest, upload gambar (jpg/png/webp maks 2 MB), slug unik, berat (gram), daya tahan (hari), tanda unggulan, pencarian, filter kategori, pagination
- **Etalase**: hero, produk unggulan, chip kategori, halaman detail, halaman toko `/toko/{slug}`, placeholder gambar SVG lokal
- **Keranjang** di session, dikelompokkan per toko
- **Checkout** di dalam `DB::transaction` + `lockForUpdate`: cek stok, **satu pesanan per toko**, kode invoice, snapshot harga, stok berkurang
- **Pesanan**: riwayat pesanan customer; seller melihat dan mengubah status pesanan tokonya; admin/staff melihat semua
- **Dashboard** dengan kartu statistik (per toko untuk seller, seluruh marketplace untuk admin/staff)
- **Keamanan**: CSRF di semua form, escaping Blade `{{ }}`, Eloquent (parameter binding), Policy (`ProductPolicy`, `TransactionPolicy`), halaman error 403/404/419/500, pesan validasi Bahasa Indonesia

## Hak Akses

| Fitur | Admin | Staff | Seller | Customer | Tamu |
|---|:-:|:-:|:-:|:-:|:-:|
| Lihat etalase & halaman toko | ✅ | ✅ | ✅ | ✅ | ✅ |
| Keranjang & checkout | ❌ | ❌ | ❌ | ✅ | ❌ |
| Riwayat pesanan sendiri | — | — | — | ✅ | ❌ |
| Panel & dashboard | ✅ | ✅ | ✅ (tokonya) | ❌ | ❌ |
| CRUD produk | ✅ semua | ✅ semua | ✅ milik tokonya | ❌ | ❌ |
| Lihat & ubah status pesanan | ✅ semua | ✅ semua | ✅ pesanan tokonya | ❌ | ❌ |
| Edit profil toko | — | — | ✅ | ❌ | ❌ |
| CRUD kategori | ✅ | ✅ | ❌ | ❌ | ❌ |
| Verifikasi toko & kelola role user | ✅ | ❌ | ❌ | ❌ | ❌ |

## Akun Login (data seeder)

Semua password: `password123`

| Role | Email | Keterangan |
|---|---|---|
| Admin | admin@umkm.test | Pengelola platform |
| Staff | staff@umkm.test | Moderator |
| Customer | customer@umkm.test | Pembeli |
| Seller | seller@umkm.test | Camilan Mbok Darmi (terverifikasi) |
| Seller | kopi@umkm.test | Kopi & Teh Lereng Moga (terverifikasi) |
| Seller | batik@umkm.test | Batik Sekar Pemalang (terverifikasi) |
| Seller | comal@umkm.test | Dapur Oleh-Oleh Comal (**belum** terverifikasi, untuk contoh alur verifikasi) |

Nama toko dan alamat di seeder adalah data contoh (fiktif).

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

Buka http://127.0.0.1:8000. Tampilan memakai Tailwind CSS dan Google Font lewat CDN, jadi perlu internet.

Alternatif tanpa migration: import `database/umkm_shop.sql`.

```bash
mysql -u root -p umkm_shop < database/umkm_shop.sql
```

Menjalankan test (SQLite in-memory, tidak menyentuh database MySQL):

```bash
php artisan test
```

## Struktur Database

- `users` (id, name, email, password, role: admin/staff/seller/customer)
- `stores` (id, user_id → users **unique**, name, slug, description, address, phone, is_verified)
- `categories` (id, name, slug)
- `products` (id, store_id → stores, category_id → categories, name, slug, description, price, stock, weight_grams, shelf_life_days, is_featured, image)
- `transactions` (id, user_id → users, store_id → stores, invoice_code, total, status)
- `transaction_items` (id, transaction_id → transactions, product_id → products, qty, price = snapshot harga)

## Struktur MVC

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/LoginController.php, RegisterController.php
│   │   ├── Admin/DashboardController.php, ProductController.php, CategoryController.php,
│   │   │        OrderController.php, StoreController.php, MyStoreController.php, UserController.php
│   │   ├── ShopController.php       # etalase, detail produk, halaman toko
│   │   ├── CartController.php       # keranjang (session)
│   │   ├── CheckoutController.php   # checkout, dipecah per toko
│   │   └── OrderController.php      # riwayat & detail pesanan
│   ├── Middleware/EnsureRole.php    # middleware role:admin,staff,seller
│   └── Requests/CategoryRequest.php, ProductRequest.php
├── Models/User, Store, Category, Product, Transaction, TransactionItem
└── Policies/ProductPolicy.php, TransactionPolicy.php
resources/views/
├── layouts/ (app, admin, head)
├── components/ (product-card, product-image, flash, status-badge)
├── auth/, shop/, orders/, admin/, errors/
routes/web.php
database/migrations, seeders, umkm_shop.sql
tests/Feature/ AuthTest, RoleAccessTest, SellerAccessTest, CheckoutTest
```

Alur request: **Route** → **Middleware** (auth, role) → **Controller** (+ FormRequest, Policy) → **Model** (Eloquent ke MySQL) → **View** (Blade) → HTML.
