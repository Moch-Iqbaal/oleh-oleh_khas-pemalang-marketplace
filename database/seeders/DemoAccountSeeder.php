<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Akun uji untuk dosen penguji, terpisah dari akun seeder pengembangan.
// Password bisa diganti lewat DEMO_PASSWORD di .env.
class DemoAccountSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make(env('DEMO_PASSWORD', 'uaswad#'));

        $accounts = [
            ['name' => 'Admin Penguji', 'email' => 'demo.admin@umkm.test', 'role' => 'admin'],
            // Pemilik toko Camilan Mbok Darmi (lihat StoreSeeder)
            ['name' => 'Bu Darmi', 'email' => 'demo.seller@umkm.test', 'role' => 'seller'],
            ['name' => 'Pembeli Penguji', 'email' => 'demo.customer@umkm.test', 'role' => 'customer'],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(['email' => $account['email']], $account + ['password' => $password]);
        }
    }
}
