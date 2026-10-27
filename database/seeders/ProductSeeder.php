<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // [toko, kategori, nama, harga, stok, berat gram, tahan (hari, null = tidak basi), unggulan, deskripsi]
        $data = [
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Grontol Jagung Gurih', 15000, 40, 250, 5, true, 'Jagung pipil rebus dengan parutan kelapa dan sedikit garam. Paling enak dimakan hari itu juga.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Kerupuk Usek Mentah', 13000, 60, 500, 90, true, 'Kerupuk usek: adonan tepung tapioka berbumbu bawang putih yang dikukus, dijemur, lalu digoreng dengan pasir panas tanpa minyak. Teman makan sayur, soto, atau bakso.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Keripik Tempe Renyah', 20000, 35, 200, 30, false, 'Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Emping Melinjo Mentah', 35000, 25, 250, 120, false, 'Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Kopi Robusta Pulosari Bubuk 250g', 25000, 30, 250, 180, true, 'Robusta dari petani lereng Gunung Slamet di Kecamatan Pulosari, sangrai medium, giling halus, tanpa campuran.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Kopi Robusta Pulosari Biji Sangrai 500g', 45000, 20, 500, 180, false, 'Biji robusta Pulosari sangrai utuh untuk yang suka menggiling sendiri.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Teh Tubruk Melati Gaya Poci', 12000, 80, 100, 365, true, 'Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Gula Batu Kristal 500g', 15000, 50, 500, 365, false, 'Pasangan wajib teh tubruk.'],
            ['batik-canting-lestari', 'batik-pemalang', 'Kain Batik Cap Motif Pemalangan', 150000, 15, 400, null, true, 'Kain batik cap 2 meter motif Pemalangan (misalnya Gemek Setekem atau Sawat Rante).'],
            ['batik-canting-lestari', 'batik-pemalang', 'Kemeja Batik Pria Lengan Panjang', 175000, 12, 350, null, false, 'Kemeja katun batik lengan panjang, ukuran M sampai XL.'],
            ['batik-canting-lestari', 'batik-pemalang', 'Selendang Batik Tulis', 210000, 6, 150, null, false, 'Selendang batik tulis halus, cocok untuk hadiah.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Paket Hampers Oleh-Oleh Pemalang', 150000, 10, 1500, 30, false, 'Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Rengginang Ketan 250g', 17000, 30, 250, 60, false, 'Rengginang ketan mentah, tinggal goreng.'],

            // Siap saji: Nasi Grombyang dan kue basah (tahan singkat)
            ['grombyang-kamir-semeru', 'siap-saji', 'Paket Nasi Grombyang Siap Saji', 40000, 20, 900, 3, true, 'Paket untuk 2 porsi: daging sapi, kuah kluwek berempah dalam kemasan terpisah, serundeng, dan bawang goreng. Simpan di kulkas, panaskan kuah sampai mendidih lalu siram ke nasi. Tahan 3 hari di kulkas.'],
            ['grombyang-kamir-semeru', 'hampers-kue', 'Kue Kamir Original isi 10', 20000, 30, 600, 4, true, 'Kue kamir khas Pemalang dari adonan terigu, telur, dan mentega dengan tape. Manis, legit, sedikit gosong di pinggir. Tahan sekitar 4 hari.'],
            ['grombyang-kamir-semeru', 'hampers-kue', 'Apem Kukus Daun Pisang', 15000, 25, 400, 2, false, 'Apem tepung beras dan santan yang dikukus beralas daun pisang. Isi 10.'],
            ['grombyang-kamir-semeru', 'hampers-kue', 'Kue Putu Ayu isi 12', 18000, 20, 350, 2, false, 'Kue putu ayu pandan dengan taburan kelapa parut.'],

            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Wajik Ketan Gula Merah', 22000, 25, 400, 7, false, 'Wajik dari beras ketan dan gula merah, legit dan wangi daun pandan.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Jenang Ketan Bungkus Klobot', 25000, 20, 500, 14, false, 'Jenang ketan santan gula merah, dibungkus kulit jagung (klobot).'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Dodol Aneka Rasa 500g', 30000, 30, 500, 60, false, 'Dodol bungkus kecil rasa original, durian, dan nangka.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Kue Lidah Kucing Toples', 45000, 20, 300, 60, false, 'Kue kering lidah kucing tipis dan renyah dalam toples.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Nastar Selai Nanas Toples', 65000, 20, 400, 45, true, 'Nastar lembut dengan selai nanas buatan sendiri.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Kastengel Keju Toples', 70000, 15, 400, 45, false, 'Kastengel keju edam, gurih dan wangi.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Kembang Goyang Renyah', 25000, 30, 250, 60, false, 'Kembang goyang tepung beras, manis gurih.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Kue Satu Kacang Hijau', 20000, 30, 250, 30, false, 'Kue satu dari tepung kacang hijau yang dicetak dan dijemur.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Semprong Gulung Wijen', 28000, 25, 250, 60, false, 'Kue semprong gulung tipis dengan wijen.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Semprong Lipat Kelapa', 28000, 25, 250, 60, false, 'Semprong lipat dengan aroma kelapa.'],
            ['dapur-oleh-oleh-comal', 'camilan-kerupuk', 'Kue Bawang Stik', 20000, 40, 250, 60, false, 'Stik bawang gurih untuk teman ngeteh.'],

            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Rempeyek Kacang Tanah', 20000, 40, 200, 30, false, 'Rempeyek tepung beras dengan kacang tanah, renyah dan gurih.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Kacang Bawang Gurih', 18000, 40, 250, 60, false, 'Kacang tanah kupas goreng dengan bawang putih.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Keripik Singkong Original', 15000, 50, 250, 60, false, 'Keripik singkong tipis, asin gurih.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Keripik Singkong Balado', 17000, 50, 250, 60, false, 'Keripik singkong dengan bumbu balado pedas manis.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Keripik Pisang Manis', 18000, 40, 250, 60, false, 'Keripik pisang tanduk dengan lapisan gula tipis.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Opak Singkong Bakar', 15000, 40, 250, 60, false, 'Opak singkong mentah, dibakar atau digoreng sebelum disantap.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Kerupuk Kulit Rambak', 25000, 30, 150, 60, false, 'Kerupuk kulit sapi yang renyah, cocok untuk teman makan.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Emping Jagung Manis', 16000, 40, 250, 60, false, 'Emping jagung pipih dengan rasa manis.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Kue Keciput Wijen', 20000, 30, 250, 60, false, 'Bola-bola kecil tepung ketan berbalut wijen.'],

            ['kopi-teh-lereng-moga', 'gula-manisan', 'Manisan Pepaya Moga', 20000, 30, 250, 30, true, 'Manisan pepaya kering dari Moga, manis dan kenyal.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Wedang Jahe Instan', 18000, 50, 200, 365, false, 'Serbuk jahe merah dan gula untuk wedang jahe hangat.'],
            ['kopi-teh-lereng-moga', 'gula-manisan', 'Nanas Madu Pemalang', 15000, 40, 1200, 7, false, 'Nanas madu segar yang manis, harga per buah.'],

            ['gula-aren-lestari-watukumpul', 'gula-manisan', 'Gula Aren Cetak Bongas 1kg', 32000, 50, 1000, 180, true, 'Gula aren padat dari Desa Bongas, Watukumpul. Dimasak dengan kayu bakar tanpa campuran, isi 5 linting.'],
            ['gula-aren-lestari-watukumpul', 'gula-manisan', 'Gula Aren Cair 250ml', 25000, 40, 300, 180, false, 'Gula aren cair untuk kopi, es, dan kue.'],

            ['hasil-laut-tanjungsari', 'olahan-laut', 'Ikan Asin Teri Nasi 250g', 30000, 30, 250, 90, false, 'Teri nasi asin kering, kecil dan gurih.'],
            ['hasil-laut-tanjungsari', 'olahan-laut', 'Ikan Asin Jambal 250g', 40000, 25, 250, 90, false, 'Ikan asin jambal kering untuk digoreng atau dibakar.'],
            ['hasil-laut-tanjungsari', 'olahan-laut', 'Terasi Udang Rebon', 15000, 40, 200, 180, false, 'Terasi dari udang rebon untuk sambal dan masakan.'],
            ['hasil-laut-tanjungsari', 'olahan-laut', 'Kerupuk Udang Mentah 500g', 35000, 30, 500, 120, false, 'Kerupuk udang mentah, mekar besar saat digoreng.'],
            ['hasil-laut-tanjungsari', 'olahan-laut', 'Abon Sapi 100g', 35000, 25, 100, 90, false, 'Abon daging sapi manis gurih.'],

            ['batik-canting-lestari', 'batik-pemalang', 'Sarung Batik Cap', 135000, 15, 450, null, false, 'Sarung batik cap katun, nyaman untuk sehari-hari.'],
            ['batik-canting-lestari', 'batik-pemalang', 'Kain Batik Tulis 2 Meter', 250000, 8, 400, null, false, 'Kain batik tulis halus, panjang 2 meter.'],
            ['batik-canting-lestari', 'batik-pemalang', 'Blangkon Batik', 60000, 15, 150, null, false, 'Blangkon batik untuk acara adat atau koleksi.'],

            ['anyaman-bambu-randudongkal', 'kerajinan-bambu', 'Bakul Anyaman Bambu', 35000, 20, 400, null, false, 'Bakul bambu anyaman tangan untuk nasi atau wadah serbaguna.'],
        ];

        foreach ($data as [$storeSlug, $categorySlug, $name, $price, $stock, $weight, $shelf, $featured, $description]) {
            $slug = Str::slug($name);
            // Foto statis di public/images/products (ikut ter-commit, tetap ada setelah deploy)
            $image = file_exists(public_path("images/products/{$slug}.webp")) ? "images/products/{$slug}.webp" : null;

            Product::updateOrCreate(['slug' => $slug], [
                'store_id' => Store::where('slug', $storeSlug)->firstOrFail()->id,
                'category_id' => Category::where('slug', $categorySlug)->firstOrFail()->id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'weight_grams' => $weight,
                'shelf_life_days' => $shelf,
                'is_featured' => $featured,
                'image' => $image,
            ]);
        }
    }
}
