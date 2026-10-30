<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        // Nama toko fiktif. Lokasi = tempat publik di sentra produk aslinya (pasar, desa sentra, TPI, jalan),
        // bukan alamat usaha tertentu. Koordinat dari OpenStreetMap (Nominatim), dicek dengan reverse geocode.
        $stores = [
            ['demo.seller@umkm.test', 'Camilan Mbok Darmi', 'Kerupuk usek dan camilan rumahan dari perajin Kalimas, dijual di kios Pasar Randudongkal.', 'Pasar Randudongkal', 'Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah', -7.1036051, 109.3244742, '081200000001', true],
            ['kopi@umkm.test', 'Kopi & Teh Lereng Moga', 'Kopi robusta petani lereng Gunung Slamet (Pulosari) dan manisan pepaya Moga.', 'Pasar Moga', 'Kios di Pasar Moga, Jl. Raya Moga - Pulosari, Kec. Moga, Kab. Pemalang, Jawa Tengah', -7.1235743, 109.2463483, '081200000002', true],
            ['batik@umkm.test', 'Batik Canting Lestari', 'Batik tulis dan cap motif Pemalangan dari perajin Taman, kiosnya di los sandang Pasar Pagi Pemalang.', 'Pasar Pagi Pemalang', 'Kios di Pasar Pagi Pemalang, Jl. Mawar, Kel. Mulyoharjo, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8890280, 109.3911390, '081200000003', true],
            ['comal@umkm.test', 'Dapur Oleh-Oleh Comal', 'Kue kering, jajanan tradisional, dan paket hampers dari kios di Pasar Comal.', 'Pasar Comal', 'Kios di Pasar Comal, Posongan, Kel. Purwoharjo, Kec. Comal, Kab. Pemalang, Jawa Tengah', -6.9057000, 109.5334000, '081200000004', true],
            ['grombyang@umkm.test', 'Grombyang & Kamir Semeru', 'Paket nasi grombyang dan kue kamir, lapak kuliner di kawasan Alun-Alun Pemalang.', 'Alun-Alun Pemalang', 'Kios di Alun-Alun Pemalang, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8902901, 109.3806267, '081200000005', true],
            ['aren@umkm.test', 'Gula Aren Lestari Watukumpul', 'Gula aren cetak dan cair dari perajin Bongas, Watukumpul, plus nanas madu Belik, dijual di Pasar Belik.', 'Pasar Belik', 'Kios di Pasar Belik, Jl. Raya Belik - Pulosari, Kec. Belik, Kab. Pemalang, Jawa Tengah', -7.1870190, 109.3295400, '081200000006', true],
            ['laut@umkm.test', 'Hasil Laut Tanjungsari', 'Ikan asin, terasi, dan kerupuk udang dari nelayan TPI Tanjungsari.', 'TPI Tanjungsari Pemalang', 'Kios di TPI Tanjungsari Pemalang, Jl. Yos Sudarso, Kel. Sugihwaras, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8685483, 109.3684456, '081200000007', true],
            // Toko ini sengaja belum diverifikasi untuk contoh alur verifikasi admin
            ['bambu@umkm.test', 'Anyaman Bambu Randudongkal', 'Bakul dan wadah anyaman bambu buatan tangan, dijual di Pasar Randudongkal.', 'Pasar Randudongkal', 'Kios di Pasar Randudongkal, Jembatan Comal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah', -7.1036051, 109.3244742, '081200000008', false],
        ];

        foreach ($stores as [$email, $name, $description, $place, $address, $lat, $lng, $phone, $verified]) {
            $user = User::where('email', $email)->firstOrFail();
            $slug = Str::slug($name);
            $photo = file_exists(public_path("images/stores/{$slug}.webp")) ? "images/stores/{$slug}.webp" : null;

            Store::updateOrCreate(['user_id' => $user->id], [
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'photo' => $photo,
                'place_name' => $place,
                'address' => $address,
                'latitude' => $lat,
                'longitude' => $lng,
                'phone' => $phone,
                'is_verified' => $verified,
            ]);
        }
    }
}
