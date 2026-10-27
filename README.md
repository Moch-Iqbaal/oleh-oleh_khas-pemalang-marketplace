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
| Seller | batik@umkm.test | Batik Canting Lestari (terverifikasi) |
| Seller | comal@umkm.test | Dapur Oleh-Oleh Comal (terverifikasi) |
| Seller | grombyang@umkm.test | Grombyang & Kamir Semeru (terverifikasi) |
| Seller | aren@umkm.test | Gula Aren Lestari Watukumpul (terverifikasi) |
| Seller | laut@umkm.test | Hasil Laut Tanjungsari (terverifikasi) |
| Seller | bambu@umkm.test | Anyaman Bambu Randudongkal (**belum** terverifikasi, untuk contoh alur verifikasi) |

Nama toko di seeder fiktif. Lokasi toko memakai tempat publik di sentra produk aslinya (pasar, desa sentra, TPI, jalan), bukan alamat usaha tertentu. Lihat bagian Sumber Data Riset.

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
- `stores` (id, user_id → users **unique**, name, slug, description, photo, address, latitude, longitude, phone, is_verified)
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

## Sumber Data Riset

Nama toko dan pemilik di seeder **fiktif**. Jenis produk, kisaran harga, dan lokasi sentra diambil dari sumber publik berikut.

**Lokasi toko** (titik tempat publik di sentra, koordinat dari OpenStreetMap/Nominatim, dicek dengan reverse geocode):

| Toko (fiktif) | Sentra / tempat publik | Koordinat |
|---|---|---|
| Camilan Mbok Darmi | Desa Kalimas, Randudongkal (sentra IKM kerupuk keyel) | -7.0646606, 109.3095822 |
| Kopi & Teh Lereng Moga | Pasar Moga, Jl. Raya Moga - Pulosari | -7.1235743, 109.2463483 |
| Batik Canting Lestari | Desa Jebed Utara, Taman (desa sentra batik Pemalangan) | -6.9212860, 109.4167607 |
| Dapur Oleh-Oleh Comal | Pasar Bantakan, Jl. Raya Pemalang - Pekalongan | -6.8707291, 109.5222769 |
| Grombyang & Kamir Semeru | Jl. Semeru, Mulyoharjo (kampung asal kue kamir) | -6.8933948, 109.3839709 |
| Gula Aren Lestari Watukumpul | Desa Bongas, Watukumpul (sentra gula aren) | -7.1904959, 109.4877398 |
| Hasil Laut Tanjungsari | TPI Tanjungsari, Jl. Raya Tegal - Pemalang | -6.8685483, 109.3684456 |
| Anyaman Bambu Randudongkal | Pasar Randudongkal | -7.1028686, 109.3248093 |

**Produk dan harga:**

- Nasi grombyang (isi, kuah kluwek, sejak ±1960-an, Rp16.000/porsi pada 2021): [jatengprov.go.id](https://jatengprov.go.id/beritaopd/masuk-warisan-budaya-ini-keistimewaan-nasi-grombyang-pemalang/), [Kompas](https://regional.kompas.com/read/2023/10/12/222712778/mengapa-pemalang-dijuluki-kota-grombyang)
- Kue kamir (Kampung Arab Mulyoharjo, Jl. Semeru, Rp2.000/biji, awet ±4 hari): [pemalangkab.go.id](https://pemalangkab.go.id/2017/01/kuliner-pemalang-khamir-arab), [infopemalang.com](https://www.infopemalang.com/2021/04/jajanan-legendaris-kamir-khas-pemalang.html)
- Kerupuk usek (digoreng pasir, Rp10.000–15.000/bungkus): [radarcbs.com](https://radarcbs.com/read/5122/daftar-kuliner-dan-oleh-oleh-khas-pemalang-yang-murah-mulai-rp10-ribuan)
- Sentra kerupuk keyel Desa Kalimas, Randudongkal: [ANTARA Jateng](https://jateng.antaranews.com/berita/628555/kemenkum-jateng-dampingi-pembinaan-ki-merek-kolektif-kerupuk-keyel-di-pemalang)
- Gula aren Bongas, Watukumpul (±Rp27.500/kg di produsen): [amunisi.co.id](https://amunisi.co.id/produk-gula-aren-bongas-masih-tradisional-tapi-asli-tanpa-campuran/)
- Kopi robusta Pulosari (biji Rp48.000–50.000/kg di petani; bubuk Rp60.000–100.000/kg): [Disway Jateng](https://jateng.disway.id/disway-pekalongan/read/713129/harga-kopi-di-tingkat-petani-di-pemalang-anjlok), [Universitas Harkat Negeri](https://harkatnegeri.ac.id/berita/universitas-harkat-negeri-dampingi-petani-kopi-cikedung-pemalang-wujudkan-ekonomi-berdaya-melalui-hibah-kemendikti-saintek-68da6720bfb6d)
- Manisan pepaya Moga, nanas madu, apem, semprong di gerai oleh-oleh PKK Pemalang: [Espos](https://regional.espos.id/cari-oleh-oleh-khas-pemalang-di-gerai-ini-lengkap-tersedia-1123842)
- Sentra batik Pemalangan (Jebed Utara, Cibelok, motif Gemek Setekem, Sawat Rante, dll.): [Jurnal Tekstil (DOI 10.24821/jtks.v9i1.9393)](https://doi.org/10.24821/jtks.v9i1.9393), [Visit Jawa Tengah](https://visitjawatengah.jatengprov.go.id/en/shopping/batik-of-pemalang)
- TPI Tanjungsari sebagai titik nelayan Pemalang: data OpenStreetMap

Produk lain (kue kering, camilan, olahan laut) adalah produk lokal umum dengan harga perkiraan pasar, tidak diklaim sebagai "khas Pemalang".

## Kredit Gambar

Foto produk di `public/images/products/`, foto toko di `public/images/stores/`, dan foto sorotan di `public/images/highlight/` diambil dari Wikimedia Commons, diperkecil ke lebar maks 800px dan dikonversi ke WebP. Foto bersifat ilustrasi (bukan foto produk asli toko).

| File | Sumber | Pembuat | Lisensi |
|---|---|---|---|
| `grontol-jagung-gurih.webp` | [Grontol hariadhi.jpg](https://commons.wikimedia.org/wiki/File:Grontol_hariadhi.jpg) | Hariadhi | CC BY-SA 4.0 |
| `kerupuk-usek-mentah.webp` | [Kerupuk Pasir.jpg](https://commons.wikimedia.org/wiki/File:Kerupuk_Pasir.jpg) | Ivuvisual | CC BY-SA 4.0 |
| `keripik-tempe-renyah.webp` | [Keripik tempe.jpg](https://commons.wikimedia.org/wiki/File:Keripik_tempe.jpg) | Wiwik P | CC BY-SA 4.0 |
| `emping-melinjo-mentah.webp` | [Emping blinjo Sidoarjo.jpg](https://commons.wikimedia.org/wiki/File:Emping_blinjo_Sidoarjo.jpg) | Midori | CC BY 3.0 |
| `kopi-robusta-pulosari-bubuk-250g.webp` | [Coffee powdered.jpg](https://commons.wikimedia.org/wiki/File:Coffee_powdered.jpg) | Kulmalukko | CC BY-SA 3.0 |
| `kopi-robusta-pulosari-biji-sangrai-500g.webp` | [Roasted coffee beans.jpg](https://commons.wikimedia.org/wiki/File:Roasted_coffee_beans.jpg) | MarkSweep | Public domain |
| `teh-tubruk-melati-gaya-poci.webp` | [Teh Poci Gula Batu.jpg](https://commons.wikimedia.org/wiki/File:Teh_Poci_Gula_Batu.jpg) | Gunawan Kartapranata | CC BY-SA 4.0 |
| `gula-batu-kristal-500g.webp` | [Kandiszucker -- 2018 -- 3588.jpg](https://commons.wikimedia.org/wiki/File:Kandiszucker_--_2018_--_3588.jpg) | Dietmar Rabich | CC BY-SA 4.0 |
| `kain-batik-cap-motif-pemalangan.webp` | [Kain Batik Tulis Lasem Gringsing.jpg](https://commons.wikimedia.org/wiki/File:Kain_Batik_Tulis_Lasem_Gringsing.jpg) | Fredi2025 | CC BY-SA 4.0 |
| `kemeja-batik-pria-lengan-panjang.webp` | [Kemeja batik Tiga Negeri.jpg](https://commons.wikimedia.org/wiki/File:Kemeja_batik_Tiga_Negeri.jpg) | Rifacan14 | CC BY 4.0 |
| `selendang-batik-tulis.webp` | [Kain Selendang Batik Tiga Negeri Lasem.jpg](https://commons.wikimedia.org/wiki/File:Kain_Selendang_Batik_Tiga_Negeri_Lasem.jpg) | Candramawa99 | CC BY 4.0 |
| `paket-hampers-oleh-oleh-pemalang.webp` | [Besek Atau Tumbu Dari Bahan Bambu Di Kebumen Jateng NKRI.jpg](https://commons.wikimedia.org/wiki/File:Besek_Atau_Tumbu_Dari_Bahan_Bambu_Di_Kebumen_Jateng_NKRI.jpg) | SATELIT BM | CC BY-SA 4.0 |
| `rengginang-ketan-250g.webp` | [Rengginang.jpg](https://commons.wikimedia.org/wiki/File:Rengginang.jpg) | Taman Renyah | CC BY-SA 3.0 |
| `abon-sapi-100g.webp` | [Abon sapi.JPG](https://commons.wikimedia.org/wiki/File:Abon_sapi.JPG) | Sakurai Midori | CC BY 3.0 |
| `apem-kukus-daun-pisang.webp` | [Kue apam.jpg](https://commons.wikimedia.org/wiki/File:Kue_apam.jpg) | Wadaihangit | CC BY-SA 4.0 |
| `bakul-anyaman-bambu.webp` | [Anyaman bambu-Kalo.jpg](https://commons.wikimedia.org/wiki/File:Anyaman_bambu-Kalo.jpg) | Desa.gedangdowo | CC BY-SA 4.0 |
| `blangkon-batik.webp` | [Ngayogyakarta-style blangkon, 2015-05-17 04.jpg](https://commons.wikimedia.org/wiki/File:Ngayogyakarta-style_blangkon,_2015-05-17_04.jpg) | Crisco 1492 | CC BY-SA 4.0 |
| `dodol-aneka-rasa-500g.webp` | [Dodol Garut Cihampelas Bandung.JPG](https://commons.wikimedia.org/wiki/File:Dodol_Garut_Cihampelas_Bandung.JPG) | Midori | CC BY 3.0 |
| `emping-jagung-manis.webp` | [Cornflakes natur 2.jpg](https://commons.wikimedia.org/wiki/File:Cornflakes_natur_2.jpg) | GeoTrinity | CC BY-SA 3.0 |
| `gula-aren-cair-250ml.webp` | [Nolen gur, known as new jaggery or Palm sugar, from Kakdwip, West Bengal, India.jpg](https://commons.wikimedia.org/wiki/File:Nolen_gur,_known_as_new_jaggery_or_Palm_sugar,_from_Kakdwip,_West_Bengal,_India.jpg) | Billjones94 | CC0 |
| `gula-aren-cetak-bongas-1kg.webp` | [Gula kelapa.jpg](https://commons.wikimedia.org/wiki/File:Gula_kelapa.jpg) | Edi Wibowo | CC BY-SA 3.0 |
| `ikan-asin-jambal-250g.webp` | [Dried ammasat upernavik 2007-07-08.jpg](https://commons.wikimedia.org/wiki/File:Dried_ammasat_upernavik_2007-07-08.jpg) | Kim Hansen | CC BY-SA 3.0 |
| `ikan-asin-teri-nasi-250g.webp` | [Dried fish in Chittagong 03.jpg](https://commons.wikimedia.org/wiki/File:Dried_fish_in_Chittagong_03.jpg) | Kritzolina | CC BY-SA 4.0 |
| `jenang-ketan-bungkus-klobot.webp` | [Dodol Gorontalo.jpg](https://commons.wikimedia.org/wiki/File:Dodol_Gorontalo.jpg) | Supardisahabu | CC BY-SA 4.0 |
| `kacang-bawang-gurih.webp` | [Kacang Bagula 005.jpg](https://commons.wikimedia.org/wiki/File:Kacang_Bagula_005.jpg) | Tim WikiPuluran- WikiBanua | CC BY-SA 4.0 |
| `kain-batik-tulis-2-meter.webp` | [Sarung batik 2 warna.jpg](https://commons.wikimedia.org/wiki/File:Sarung_batik_2_warna.jpg) | SALAMMALAS | CC BY-SA 4.0 |
| `kastengel-keju-toples.webp` | [Kastengel 2.JPG](https://commons.wikimedia.org/wiki/File:Kastengel_2.JPG) | Sakurai Midori | CC BY 3.0 |
| `kembang-goyang-renyah.webp` | [Kembang goyang (2).jpg](https://commons.wikimedia.org/wiki/File:Kembang_goyang_(2).jpg) | Bangrapip | CC BY-SA 4.0 |
| `keripik-pisang-manis.webp` | [Kerala banana chips Upperi varuthath.jpg](https://commons.wikimedia.org/wiki/File:Kerala_banana_chips_Upperi_varuthath.jpg) | Ramesh NG | CC BY-SA 2.0 |
| `keripik-singkong-balado.webp` | [Keripik singkong balado cassava chips.JPG](https://commons.wikimedia.org/wiki/File:Keripik_singkong_balado_cassava_chips.JPG) | Sakurai Midori | CC BY-SA 3.0 |
| `keripik-singkong-original.webp` | [Tapioca Chips 2.jpg](https://commons.wikimedia.org/wiki/File:Tapioca_Chips_2.jpg) | Gaurav Dhwaj Khadka | CC BY-SA 4.0 |
| `kerupuk-kulit-rambak.webp` | [Kerupuk kulit.JPG](https://commons.wikimedia.org/wiki/File:Kerupuk_kulit.JPG) | Midori | CC BY 3.0 |
| `kerupuk-udang-mentah-500g.webp` | [Prawn Cracker with Black Pepper.jpg](https://commons.wikimedia.org/wiki/File:Prawn_Cracker_with_Black_Pepper.jpg) | See-ming Lee | CC BY 2.0 |
| `kue-bawang-stik.webp` | [Kue Bawang 01122024.jpg](https://commons.wikimedia.org/wiki/File:Kue_Bawang_01122024.jpg) | Hzu Hzu | CC BY-SA 4.0 |
| `kue-kamir-original-isi-10.webp` | [Kamir Arab kecil.jpg](https://commons.wikimedia.org/wiki/File:Kamir_Arab_kecil.jpg) | Naval Scene | CC BY-SA 3.0 |
| `kue-keciput-wijen.webp` | [Keciput.jpg](https://commons.wikimedia.org/wiki/File:Keciput.jpg) | Indonesiagood | CC BY 4.0 |
| `kue-lidah-kucing-toples.webp` | [Kue Lidah Kucing 1.jpg](https://commons.wikimedia.org/wiki/File:Kue_Lidah_Kucing_1.jpg) | Gunawan Kartapranata | CC BY-SA 4.0 |
| `kue-putu-ayu-isi-12.webp` | [Putri Ayu.jpg](https://commons.wikimedia.org/wiki/File:Putri_Ayu.jpg) | Supardisahabu | CC BY-SA 4.0 |
| `kue-satu-kacang-hijau.webp` | [Kue satu.JPG](https://commons.wikimedia.org/wiki/File:Kue_satu.JPG) | Midori | CC BY 3.0 |
| `manisan-pepaya-moga.webp` | [Alua dari Pepaya.jpg](https://commons.wikimedia.org/wiki/File:Alua_dari_Pepaya.jpg) | Mia Sulisnawati | CC BY-SA 4.0 |
| `nanas-madu-pemalang.webp` | [Nanas Madu.jpg](https://commons.wikimedia.org/wiki/File:Nanas_Madu.jpg) | Revianashafira | CC BY 4.0 |
| `nastar-selai-nanas-toples.webp` | [Tat nanas (Pineapple tart) 20230425 084103.jpg](https://commons.wikimedia.org/wiki/File:Tat_nanas_(Pineapple_tart)_20230425_084103.jpg) | Wiki Farazi | CC0 |
| `opak-singkong-bakar.webp` | [Karupuak Lento 2.jpg](https://commons.wikimedia.org/wiki/File:Karupuak_Lento_2.jpg) | S Kartika | CC BY-SA 4.0 |
| `paket-nasi-grombyang-siap-saji.webp` | [Sega Grombyang.jpg](https://commons.wikimedia.org/wiki/File:Sega_Grombyang.jpg) | Ronald Sumardi | CC BY 4.0 |
| `rempeyek-kacang-tanah.webp` | [Rempeyek kacang hijau 20230421 121100.jpg](https://commons.wikimedia.org/wiki/File:Rempeyek_kacang_hijau_20230421_121100.jpg) | Wiki Farazi | CC0 |
| `sarung-batik-cap.webp` | [SARUNG BATIK TULIS.jpg](https://commons.wikimedia.org/wiki/File:SARUNG_BATIK_TULIS.jpg) | CANON96 | CC BY-SA 4.0 |
| `semprong-gulung-wijen.webp` | [Kue Curuti Gorontalo.jpg](https://commons.wikimedia.org/wiki/File:Kue_Curuti_Gorontalo.jpg) | Supardisahabu | CC BY-SA 4.0 |
| `semprong-lipat-kelapa.webp` | [Kue kipas tampak dekat.jpg](https://commons.wikimedia.org/wiki/File:Kue_kipas_tampak_dekat.jpg) | HaidirAndiNovianto | CC BY-SA 4.0 |
| `terasi-udang-rebon.webp` | [Terasi-dari-lombok.jpg](https://commons.wikimedia.org/wiki/File:Terasi-dari-lombok.jpg) | Hminandar | CC BY-SA 3.0 |
| `wajik-ketan-gula-merah.webp` | [Wajik Ketan Gula Merah.jpg](https://commons.wikimedia.org/wiki/File:Wajik_Ketan_Gula_Merah.jpg) | Irnabela | CC BY 4.0 |
| `wedang-jahe-instan.webp` | [Lemongrass ginger tea.jpg](https://commons.wikimedia.org/wiki/File:Lemongrass_ginger_tea.jpg) | AyyanD | CC BY-SA 4.0 |

### Foto toko dan sorotan

Foto toko adalah suasana usaha/produksi (bukan foto pemilik toko yang fiktif).

| File | Sumber | Pembuat | Lisensi |
|---|---|---|---|
| `stores/anyaman-bambu-randudongkal.webp` | [Anyaman bambu-Kalo.jpg](https://commons.wikimedia.org/wiki/File:Anyaman_bambu-Kalo.jpg) | Desa.gedangdowo | CC BY-SA 4.0 |
| `stores/batik-canting-lestari.webp` | [Using canting to create batik (10684550014).jpg](https://commons.wikimedia.org/wiki/File:Using_canting_to_create_batik_(10684550014).jpg) | Ahmad Salman/AusAID | CC BY 2.0 |
| `stores/camilan-mbok-darmi.webp` | [Kerupuk Kulit Rambak Prabumulih.jpg](https://commons.wikimedia.org/wiki/File:Kerupuk_Kulit_Rambak_Prabumulih.jpg) | Nasywaaf | CC BY 4.0 |
| `stores/dapur-oleh-oleh-comal.webp` | [Pembuat Dodol.jpg](https://commons.wikimedia.org/wiki/File:Pembuat_Dodol.jpg) | Arie Basuki | CC BY-SA 4.0 |
| `stores/gula-aren-lestari-watukumpul.webp` | [Sang pembuat gula aren.jpg](https://commons.wikimedia.org/wiki/File:Sang_pembuat_gula_aren.jpg) | Iam.arianaga | CC BY-SA 4.0 |
| `stores/hasil-laut-tanjungsari.webp` | [Dried fish at Fareniya Bazar, Indo Nepal Border Trail, Sonauli-IMG 7198.jpg](https://commons.wikimedia.org/wiki/File:Dried_fish_at_Fareniya_Bazar,_Indo_Nepal_Border_Trail,_Sonauli-IMG_7198.jpg) | Bijay Chaurasia | CC BY-SA 4.0 |
| `stores/kopi-teh-lereng-moga.webp` | [Kopi Luwak, Yogyakarta, Indonesia.jpg](https://commons.wikimedia.org/wiki/File:Kopi_Luwak,_Yogyakarta,_Indonesia.jpg) | Etsuma.W | CC BY-SA 4.0 |
| `stores/grombyang-kamir-semeru.webp` | [Kue Samir 2.jpg](https://commons.wikimedia.org/wiki/File:Kue_Samir_2.jpg) | Gunawan Kartapranata | CC BY-SA 4.0 |
| `highlight/nasi-grombyang.webp` | [Sega Grombyang.jpg](https://commons.wikimedia.org/wiki/File:Sega_Grombyang.jpg) | Ronald Sumardi | CC BY 4.0 |

Lisensi CC BY / CC BY-SA mewajibkan atribusi; gambar yang diperkecil termasuk karya turunan dan dibagikan dengan lisensi yang sama.
