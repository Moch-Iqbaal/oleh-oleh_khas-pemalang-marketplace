<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Camilan & Kerupuk', 'Kopi & Teh', 'Batik Pemalang', 'Hampers & Kue'] as $name) {
            Category::updateOrCreate(['slug' => Str::slug($name)], ['name' => $name]);
        }
    }
}
