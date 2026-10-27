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
            ['seller@umkm.test', 'Camilan Mbok Darmi', 'Kerupuk dan camilan rumahan dari Desa Kalimas, sentra IKM kerupuk keyel di Randudongkal.', 'Desa Kalimas, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah', -7.0646606, 109.3095822, '081200000001', true],
            ['kopi@umkm.test', 'Kopi & Teh Lereng Moga', 'Kopi robusta dari petani lereng Gunung Slamet (Pulosari) dan manisan pepaya Moga, mangkal di sekitar Pasar Moga.', 'Pasar Moga, Jl. Raya Moga - Pulosari, Kec. Moga, Kab. Pemalang, Jawa Tengah', -7.1235743, 109.2463483, '081200000002', true],
            ['batik@umkm.test', 'Batik Canting Lestari', 'Batik tulis dan cap motif Pemalangan dari perajin rumahan di Desa Jebed Utara, salah satu desa sentra batik Pemalang.', 'Desa Jebed Utara, Kec. Taman, Kab. Pemalang, Jawa Tengah', -6.9212860, 109.4167607, '081200000003', true],
            ['comal@umkm.test', 'Dapur Oleh-Oleh Comal', 'Kue kering, jajanan tradisional, dan paket hampers. Ambil pesanan di sekitar Pasar Bantakan.', 'Pasar Bantakan, Jl. Raya Pemalang - Pekalongan, Kec. Comal, Kab. Pemalang, Jawa Tengah', -6.8707291, 109.5222769, '081200000004', true],
            ['grombyang@umkm.test', 'Grombyang & Kamir Semeru', 'Paket nasi grombyang siap saji dan kue kamir dari kawasan Jl. Semeru, Mulyoharjo, kampung asal kue kamir.', 'Jl. Semeru, Kel. Mulyoharjo, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8933948, 109.3839709, '081200000005', true],
            ['aren@umkm.test', 'Gula Aren Lestari Watukumpul', 'Gula aren cetak dan cair dari Desa Bongas, Watukumpul, dimasak dengan kayu bakar.', 'Desa Bongas, Kec. Watukumpul, Kab. Pemalang, Jawa Tengah', -7.1904959, 109.4877398, '081200000006', true],
            ['laut@umkm.test', 'Hasil Laut Tanjungsari', 'Ikan asin, terasi, dan kerupuk udang dari nelayan sekitar TPI Tanjungsari.', 'TPI Tanjungsari, Jl. Raya Tegal - Pemalang, Sugihwaras, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8685483, 109.3684456, '081200000007', true],
            // Toko ini sengaja belum diverifikasi untuk contoh alur verifikasi admin
            ['bambu@umkm.test', 'Anyaman Bambu Randudongkal', 'Bakul dan wadah anyaman bambu buatan tangan, dijual di Pasar Randudongkal.', 'Pasar Randudongkal, Kec. Randudongkal, Kab. Pemalang, Jawa Tengah', -7.1028686, 109.3248093, '081200000008', false],
        ];

        foreach ($stores as [$email, $name, $description, $address, $lat, $lng, $phone, $verified]) {
            $user = User::where('email', $email)->firstOrFail();
            $slug = Str::slug($name);
            $photo = file_exists(public_path("images/stores/{$slug}.webp")) ? "images/stores/{$slug}.webp" : null;

            Store::updateOrCreate(['user_id' => $user->id], [
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'photo' => $photo,
                'address' => $address,
                'latitude' => $lat,
                'longitude' => $lng,
                'phone' => $phone,
                'is_verified' => $verified,
            ]);
        }
    }
}
