<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: produk butuh kategori sudah ada
        $this->call([
            UserSeeder::class,
            DemoAccountSeeder::class,
            StoreSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
