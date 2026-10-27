<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(int $stock, int $price = 50000): Product
    {
        $category = Category::create(['name' => 'Kuliner', 'slug' => 'kuliner']);

        return Product::create([
            'category_id' => $category->id, 'name' => 'Keripik Tempe', 'slug' => 'keripik-tempe',
            'price' => $price, 'stock' => $stock,
        ]);
    }

    public function test_checkout_mengurangi_stok_dan_menyimpan_snapshot_harga(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct(stock: 10);

        $this->actingAs($customer)
            ->withSession(['cart' => [$product->id => 3]])
            ->post('/checkout')
            ->assertRedirect();

        $this->assertSame(7, $product->fresh()->stock);
        $this->assertDatabaseHas('transactions', ['user_id' => $customer->id, 'total' => 150000]);
        $this->assertDatabaseHas('transaction_items', ['product_id' => $product->id, 'qty' => 3, 'price' => 50000]);

        // Harga produk naik, harga di transaksi lama tidak ikut berubah
        $product->update(['price' => 99000]);
        $this->assertDatabaseHas('transaction_items', ['product_id' => $product->id, 'price' => 50000]);
    }

    public function test_checkout_gagal_kalau_stok_tidak_cukup(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct(stock: 2);

        $this->actingAs($customer)
            ->withSession(['cart' => [$product->id => 5]])
            ->post('/checkout')
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('error');

        $this->assertSame(2, $product->fresh()->stock);
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_tidak_bisa_tambah_ke_keranjang_melebihi_stok(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct(stock: 1);

        $this->actingAs($customer)->post("/keranjang/{$product->id}", ['qty' => 2])
            ->assertSessionHas('error');
    }

    public function test_checkout_keranjang_kosong_ditolak(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->post('/checkout')->assertSessionHas('error');
        $this->assertDatabaseCount('transactions', 0);
    }
}
