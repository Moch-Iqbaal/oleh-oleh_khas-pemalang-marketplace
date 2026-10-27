<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'makanan-ringan' => [['Keripik Singkong Pedas', 15000, 50], ['Kue Bawang Renyah', 20000, 30]],
            'minuman' => [['Kopi Robusta Lokal 250g', 45000, 25], ['Wedang Jahe Instan', 18000, 40]],
            'kerajinan-tangan' => [['Tas Anyaman Pandan', 85000, 15], ['Gantungan Kunci Kayu', 10000, 100]],
            'fashion-batik' => [['Kemeja Batik Pria', 150000, 20], ['Selendang Batik Tulis', 120000, 10]],
        ];

        foreach ($data as $slug => $products) {
            $category = Category::where('slug', $slug)->firstOrFail();

            foreach ($products as [$name, $price, $stock]) {
                Product::updateOrCreate(['slug' => Str::slug($name)], [
                    'category_id' => $category->id,
                    'name' => $name,
                    'description' => "Produk UMKM lokal: {$name}.",
                    'price' => $price,
                    'stock' => $stock,
                ]);
            }
        }
    }
}
