<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerAccessTest extends TestCase
{
    use RefreshDatabase;

    private function seller(string $storeName): User
    {
        $user = User::factory()->create(['role' => 'seller']);
        Store::create([
            'user_id' => $user->id, 'name' => $storeName, 'slug' => str($storeName)->slug(),
            'address' => 'Pemalang', 'phone' => '08123456789', 'is_verified' => true,
        ]);

        return $user->fresh();
    }

    private function productFor(User $seller, string $name): Product
    {
        $category = Category::firstOrCreate(['slug' => 'camilan'], ['name' => 'Camilan']);

        return Product::create([
            'store_id' => $seller->store->id, 'category_id' => $category->id, 'name' => $name,
            'slug' => str($name)->slug(), 'price' => 10000, 'stock' => 10, 'weight_grams' => 100,
        ]);
    }

    public function test_seller_tidak_bisa_edit_produk_toko_lain(): void
    {
        $a = $this->seller('Toko A');
        $b = $this->seller('Toko B');
        $product = $this->productFor($b, 'Kopi Moga');

        $this->actingAs($a)->get("/admin/products/{$product->id}/edit")->assertForbidden();
        $this->actingAs($a)->put("/admin/products/{$product->id}", [
            'category_id' => $product->category_id, 'name' => 'Diubah', 'price' => 1, 'stock' => 1, 'weight_grams' => 1,
        ])->assertForbidden();
        $this->actingAs($a)->delete("/admin/products/{$product->id}")->assertForbidden();

        $this->assertSame('Kopi Moga', $product->fresh()->name);
    }

    public function test_seller_bisa_edit_produk_sendiri(): void
    {
        $a = $this->seller('Toko A');
        $product = $this->productFor($a, 'Grontol');

        $this->actingAs($a)->put("/admin/products/{$product->id}", [
            'category_id' => $product->category_id, 'name' => 'Grontol Jagung Manis',
            'price' => 12000, 'stock' => 8, 'weight_grams' => 250, 'shelf_life_days' => 3,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertSame('Grontol Jagung Manis', $product->fresh()->name);
    }

    public function test_produk_baru_seller_otomatis_masuk_tokonya(): void
    {
        $a = $this->seller('Toko A');
        $b = $this->seller('Toko B');
        $category = Category::create(['name' => 'Camilan', 'slug' => 'camilan']);

        // Mencoba menitipkan store_id toko lain harus ditolak
        $this->actingAs($a)->post('/admin/products', [
            'store_id' => $b->store->id, 'category_id' => $category->id, 'name' => 'Emping',
            'price' => 30000, 'stock' => 5, 'weight_grams' => 250,
        ])->assertSessionHasErrors('store_id');

        $this->actingAs($a)->post('/admin/products', [
            'category_id' => $category->id, 'name' => 'Emping',
            'price' => 30000, 'stock' => 5, 'weight_grams' => 250,
        ])->assertRedirect();

        $this->assertDatabaseHas('products', ['name' => 'Emping', 'store_id' => $a->store->id]);
    }

    public function test_seller_hanya_melihat_dan_mengubah_pesanan_tokonya(): void
    {
        $a = $this->seller('Toko A');
        $b = $this->seller('Toko B');
        $customer = User::factory()->create(['role' => 'customer']);
        $orderB = Transaction::create([
            'user_id' => $customer->id, 'store_id' => $b->store->id,
            'invoice_code' => 'INV-B', 'total' => 1000, 'status' => 'pending',
        ]);

        $this->actingAs($a)->get('/admin/orders')->assertOk()->assertDontSee('INV-B');
        $this->actingAs($a)->get("/pesanan/{$orderB->id}")->assertForbidden();
        $this->actingAs($a)->patch("/admin/orders/{$orderB->id}/status", ['status' => 'paid'])->assertForbidden();

        $this->actingAs($b)->patch("/admin/orders/{$orderB->id}/status", ['status' => 'paid'])->assertRedirect();
        $this->assertSame('paid', $orderB->fresh()->status);
    }

    public function test_seller_tidak_bisa_kelola_kategori_dan_verifikasi_toko(): void
    {
        $a = $this->seller('Toko A');

        $this->actingAs($a)->get('/admin/categories')->assertForbidden();
        $this->actingAs($a)->get('/admin/stores')->assertForbidden();
        $this->actingAs($a)->patch("/admin/stores/{$a->store->id}/verify")->assertForbidden();
    }

    public function test_admin_bisa_verifikasi_toko(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $a = $this->seller('Toko A');
        $a->store->update(['is_verified' => false]);

        $this->actingAs($admin)->patch("/admin/stores/{$a->store->id}/verify")->assertRedirect();
        $this->assertTrue($a->store->fresh()->is_verified);
    }
}
