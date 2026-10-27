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
            ['name' => 'Admin Toko', 'email' => 'admin@umkm.test', 'role' => 'admin'],
            ['name' => 'Staff Gudang', 'email' => 'staff@umkm.test', 'role' => 'staff'],
            ['name' => 'Budi Pembeli', 'email' => 'customer@umkm.test', 'role' => 'customer'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user + ['password' => Hash::make('password123')]
            );
        }
    }
}
