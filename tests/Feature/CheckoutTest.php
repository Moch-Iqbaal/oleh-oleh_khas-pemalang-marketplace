<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private function makeStore(string $name, bool $verified = true): Store
    {
        $owner = User::factory()->create(['role' => 'seller']);

        return Store::create([
            'user_id' => $owner->id, 'name' => $name, 'slug' => str($name)->slug(),
            'address' => 'Pemalang', 'phone' => '08123456789', 'is_verified' => $verified,
        ]);
    }

    private function makeProduct(Store $store, string $name, int $stock, int $price = 50000): Product
    {
        $category = Category::firstOrCreate(['slug' => 'camilan'], ['name' => 'Camilan']);

        return Product::create([
            'store_id' => $store->id, 'category_id' => $category->id, 'name' => $name,
            'slug' => str($name)->slug(), 'price' => $price, 'stock' => $stock, 'weight_grams' => 250,
        ]);
    }

    public function test_checkout_mengurangi_stok_dan_menyimpan_snapshot_harga(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct($this->makeStore('Toko A'), 'Keripik Tempe', stock: 10);

        $this->actingAs($customer)
            ->withSession(['cart' => [$product->id => 3]])
            ->post('/checkout')
            ->assertRedirect();

        $this->assertSame(7, $product->fresh()->stock);
        $this->assertDatabaseHas('transactions', ['user_id' => $customer->id, 'store_id' => $product->store_id, 'total' => 150000]);
        $this->assertDatabaseHas('transaction_items', ['product_id' => $product->id, 'qty' => 3, 'price' => 50000]);

        // Harga produk naik, harga di transaksi lama tidak ikut berubah
        $product->update(['price' => 99000]);
        $this->assertDatabaseHas('transaction_items', ['product_id' => $product->id, 'price' => 50000]);
    }

    public function test_checkout_dari_dua_toko_dipecah_jadi_dua_pesanan(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $a = $this->makeProduct($this->makeStore('Toko A'), 'Grontol', stock: 5, price: 15000);
        $b = $this->makeProduct($this->makeStore('Toko B'), 'Kopi Robusta', stock: 5, price: 45000);

        $this->actingAs($customer)
            ->withSession(['cart' => [$a->id => 2, $b->id => 1]])
            ->post('/checkout')
            ->assertRedirect(route('orders.index'));

        $this->assertDatabaseCount('transactions', 2);
        $this->assertDatabaseHas('transactions', ['store_id' => $a->store_id, 'total' => 30000]);
        $this->assertDatabaseHas('transactions', ['store_id' => $b->store_id, 'total' => 45000]);
    }

    public function test_checkout_gagal_kalau_stok_tidak_cukup(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct($this->makeStore('Toko A'), 'Keripik Tempe', stock: 2);

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
        $product = $this->makeProduct($this->makeStore('Toko A'), 'Keripik Tempe', stock: 1);

        $this->actingAs($customer)->post("/keranjang/{$product->id}", ['qty' => 2])
            ->assertSessionHas('error');
    }

    public function test_checkout_keranjang_kosong_ditolak(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->post('/checkout')->assertSessionHas('error');
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_produk_toko_belum_terverifikasi_disembunyikan(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $hidden = $this->makeProduct($this->makeStore('Toko Baru', verified: false), 'Rengginang Ketan', stock: 5);
        $shown = $this->makeProduct($this->makeStore('Toko Lama'), 'Emping Melinjo', stock: 5);

        $this->get('/')->assertSee('Emping Melinjo')->assertDontSee('Rengginang Ketan');
        $this->get("/produk/{$hidden->slug}")->assertNotFound();
        $this->get('/toko/toko-baru')->assertNotFound();
        $this->get("/produk/{$shown->slug}")->assertOk();
        $this->actingAs($customer)->post("/keranjang/{$hidden->id}", ['qty' => 1])->assertNotFound();
    }
}
