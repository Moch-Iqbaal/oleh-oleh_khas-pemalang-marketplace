<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Platform', 'email' => 'admin@umkm.test', 'role' => 'admin'],
            ['name' => 'Staff Moderator', 'email' => 'staff@umkm.test', 'role' => 'staff'],
            ['name' => 'Budi Perantau', 'email' => 'customer@umkm.test', 'role' => 'customer'],
            // Pemilik toko UMKM (lihat StoreSeeder)
            ['name' => 'Bu Darmi', 'email' => 'seller@umkm.test', 'role' => 'seller'],
            ['name' => 'Pak Slamet', 'email' => 'kopi@umkm.test', 'role' => 'seller'],
            ['name' => 'Mbak Sekar', 'email' => 'batik@umkm.test', 'role' => 'seller'],
            ['name' => 'Mas Arif', 'email' => 'comal@umkm.test', 'role' => 'seller'],
            ['name' => 'Bu Halimah', 'email' => 'grombyang@umkm.test', 'role' => 'seller'],
            ['name' => 'Pak Karyo', 'email' => 'aren@umkm.test', 'role' => 'seller'],
            ['name' => 'Bu Wartini', 'email' => 'laut@umkm.test', 'role' => 'seller'],
            ['name' => 'Pak Darsono', 'email' => 'bambu@umkm.test', 'role' => 'seller'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user + ['password' => Hash::make('password123')]
            );
        }
    }
}
