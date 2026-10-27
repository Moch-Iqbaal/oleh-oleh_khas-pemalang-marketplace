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
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Kerupuk Pasir (Usek) Mentah', 18000, 60, 500, 90, true, 'Kerupuk yang digoreng pakai pasir, tanpa minyak. Dijual mentah, tinggal goreng sangrai di rumah.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Keripik Tempe Renyah', 20000, 35, 200, 30, false, 'Tempe diiris tipis dan digoreng garing dengan bumbu bawang dan daun jeruk.'],
            ['camilan-mbok-darmi', 'camilan-kerupuk', 'Emping Melinjo Mentah', 35000, 25, 250, 120, false, 'Emping melinjo tumbuk tangan, siap digoreng untuk teman makan atau suguhan Lebaran.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Kopi Robusta Moga Bubuk 250g', 45000, 30, 250, 180, true, 'Robusta dari kebun rakyat di lereng selatan Pemalang, sangrai medium, giling halus.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Kopi Robusta Biji Sangrai 500g', 80000, 20, 500, 180, false, 'Biji kopi sangrai utuh untuk yang suka menggiling sendiri.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Teh Tubruk Melati Gaya Poci', 12000, 80, 100, 365, true, 'Teh hitam wangi melati untuk diseduh di poci tanah liat, nikmat dengan gula batu.'],
            ['kopi-teh-lereng-moga', 'kopi-teh', 'Gula Batu Kristal 500g', 15000, 50, 500, 365, false, 'Pasangan wajib teh tubruk.'],
            ['batik-sekar-pemalang', 'batik-pemalang', 'Kain Batik Cap Motif Pemalangan', 125000, 15, 400, null, true, 'Kain batik cap 2 meter dengan motif dan warna khas pesisir Pemalang.'],
            ['batik-sekar-pemalang', 'batik-pemalang', 'Kemeja Batik Pria Lengan Pendek', 165000, 12, 300, null, false, 'Kemeja katun batik cap, ukuran M sampai XL.'],
            ['batik-sekar-pemalang', 'batik-pemalang', 'Selendang Batik Tulis', 210000, 6, 150, null, false, 'Selendang batik tulis halus, cocok untuk hadiah.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Paket Hampers Oleh-Oleh Pemalang', 150000, 10, 1500, 30, false, 'Isi kerupuk, keripik, kopi, dan teh dalam besek bambu.'],
            ['dapur-oleh-oleh-comal', 'hampers-kue', 'Rengginang Ketan 250g', 17000, 30, 250, 60, false, 'Rengginang ketan mentah, tinggal goreng.'],
        ];

        foreach ($data as [$storeSlug, $categorySlug, $name, $price, $stock, $weight, $shelf, $featured, $description]) {
            Product::updateOrCreate(['slug' => Str::slug($name)], [
                'store_id' => Store::where('slug', $storeSlug)->firstOrFail()->id,
                'category_id' => Category::where('slug', $categorySlug)->firstOrFail()->id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'weight_grams' => $weight,
                'shelf_life_days' => $shelf,
                'is_featured' => $featured,
            ]);
        }
    }
}
