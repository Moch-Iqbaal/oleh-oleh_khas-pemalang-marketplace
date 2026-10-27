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
        // Nama toko fiktif. Koordinat = perkiraan pusat kecamatan (OpenStreetMap/Nominatim), bukan alamat asli.
        $stores = [
            ['seller@umkm.test', 'Camilan Mbok Darmi', 'Camilan rumahan dan kerupuk, digoreng tiap pagi.', 'Desa Taman, Kec. Taman, Kab. Pemalang, Jawa Tengah', -6.9013234, 109.4057555, '081200000001', true],
            ['kopi@umkm.test', 'Kopi & Teh Lereng Moga', 'Kopi robusta dari kebun rakyat di lereng selatan Pemalang, teh tubruk, dan manisan pepaya.', 'Kec. Moga, Kab. Pemalang, Jawa Tengah', -7.1159719, 109.2459363, '081200000002', true],
            ['batik@umkm.test', 'Batik Sekar Pemalang', 'Batik cap dan tulis karya perajin lokal.', 'Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8960000, 109.3780000, '081200000003', true],
            ['comal@umkm.test', 'Dapur Oleh-Oleh Comal', 'Kue kering, jajanan tradisional, dan paket hampers untuk kiriman keluarga.', 'Kec. Comal, Kab. Pemalang, Jawa Tengah', -6.9063768, 109.5331389, '081200000004', true],
            ['grombyang@umkm.test', 'Warung Grombyang & Kamir Kauman', 'Paket nasi grombyang siap saji dan kue kamir buatan rumahan.', 'Kel. Kauman, Kec. Pemalang, Kab. Pemalang, Jawa Tengah', -6.8873513, 109.3882311, '081200000005', true],
            ['aren@umkm.test', 'Gula Aren Lestari Watukumpul', 'Gula aren cetak dan cair dari nira pohon aren, dimasak dengan kayu bakar.', 'Kec. Watukumpul, Kab. Pemalang, Jawa Tengah', -7.1567969, 109.4201937, '081200000006', true],
            ['laut@umkm.test', 'Hasil Laut Ulujami', 'Ikan asin, terasi, dan kerupuk udang dari pesisir Pemalang timur.', 'Kec. Ulujami, Kab. Pemalang, Jawa Tengah', -6.8835112, 109.5655788, '081200000007', true],
            // Toko ini sengaja belum diverifikasi untuk contoh alur verifikasi admin
            ['bambu@umkm.test', 'Anyaman Bambu Randudongkal', 'Bakul dan wadah anyaman bambu buatan tangan.', 'Kec. Randudongkal, Kab. Pemalang, Jawa Tengah', -7.0999072, 109.3235966, '081200000008', false],
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
