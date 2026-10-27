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
        // Nama toko fiktif, alamat dibuat umum per kecamatan di Kabupaten Pemalang
        $stores = [
            ['seller@umkm.test', 'Camilan Mbok Darmi', 'Camilan rumahan dan kerupuk khas Pemalang, digoreng tiap pagi.', 'Kec. Taman, Pemalang, Jawa Tengah', '081200000001', true],
            ['kopi@umkm.test', 'Kopi & Teh Lereng Moga', 'Kopi robusta dari petani dataran tinggi Pemalang selatan dan teh tubruk wangi melati.', 'Kec. Moga, Pemalang, Jawa Tengah', '081200000002', true],
            ['batik@umkm.test', 'Batik Sekar Pemalang', 'Batik cap dan tulis motif Pemalangan karya perajin lokal.', 'Kec. Pemalang, Pemalang, Jawa Tengah', '081200000003', true],
            // Toko ini sengaja belum diverifikasi untuk contoh alur verifikasi admin
            ['comal@umkm.test', 'Dapur Oleh-Oleh Comal', 'Paket hampers dan kue kering untuk kiriman keluarga.', 'Kec. Comal, Pemalang, Jawa Tengah', '081200000004', false],
        ];

        foreach ($stores as [$email, $name, $description, $address, $phone, $verified]) {
            $user = User::where('email', $email)->firstOrFail();

            Store::updateOrCreate(['user_id' => $user->id], [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'address' => $address,
                'phone' => $phone,
                'is_verified' => $verified,
            ]);
        }
    }
}
