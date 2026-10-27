<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecurityTest extends TestCase
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

    private function product(User $seller, string $name): Product
    {
        $category = Category::firstOrCreate(['slug' => 'camilan'], ['name' => 'Camilan']);

        return Product::create([
            'store_id' => $seller->store->id, 'category_id' => $category->id, 'name' => $name,
            'slug' => str($name)->slug() ?: 'produk-'.uniqid(), 'price' => 10000, 'stock' => 10, 'weight_grams' => 100,
        ]);
    }

    private function productPayload(array $override = []): array
    {
        return array_merge([
            'category_id' => Category::firstOrCreate(['slug' => 'camilan'], ['name' => 'Camilan'])->id,
            'name' => 'Kerupuk Usek', 'price' => 13000, 'stock' => 5, 'weight_grams' => 500,
        ], $override);
    }

    public function test_xss_di_nama_produk_di_escape_di_halaman(): void
    {
        $seller = $this->seller('Toko A');
        $product = $this->product($seller, 'Kerupuk <script>alert(1)</script>');

        $this->get('/produk/'.$product->slug)->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
        $this->get('/?q=<script>alert(1)</script>')->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_tag_html_dibuang_saat_simpan_produk_lewat_form(): void
    {
        $seller = $this->seller('Toko A');

        $this->actingAs($seller)->post('/admin/products', $this->productPayload([
            'name' => 'Kerupuk <img src=x onerror=alert(1)>Usek',
            'description' => '<script>alert(document.cookie)</script>Renyah',
        ]))->assertRedirect();

        $product = Product::firstOrFail();
        $this->assertSame('Kerupuk Usek', $product->name);
        $this->assertSame('alert(document.cookie)Renyah', $product->description);
    }

    public function test_payload_sqli_di_pencarian_tidak_error_dan_tidak_bocor(): void
    {
        $seller = $this->seller('Toko A');
        $this->product($seller, 'Kopi Moga');

        foreach (["' OR '1'='1", "'; DROP TABLE products; --", '" UNION SELECT password FROM users --'] as $payload) {
            $this->get('/?q='.urlencode($payload))->assertOk()->assertDontSee('Kopi Moga');
        }
        $this->get('/?q[]=x')->assertOk();
        $this->assertDatabaseCount('products', 1);
    }

    public function test_wildcard_like_dicari_apa_adanya(): void
    {
        $seller = $this->seller('Toko A');
        $this->product($seller, 'Kopi Moga');

        $this->get('/?q=%25')->assertOk()->assertDontSee('Kopi Moga');
        $this->get('/?q=_')->assertOk()->assertDontSee('Kopi Moga');
        $this->get('/?q=Moga')->assertOk()->assertSee('Kopi Moga');
    }

    public function test_seller_idor_edit_produk_toko_lain_403(): void
    {
        $a = $this->seller('Toko A');
        $product = $this->product($this->seller('Toko B'), 'Batik Tulis');

        $this->actingAs($a)->put("/admin/products/{$product->id}", $this->productPayload(['name' => 'Dibajak']))->assertForbidden();
        $this->actingAs($a)->delete("/admin/products/{$product->id}")->assertForbidden();
        $this->assertSame('Batik Tulis', $product->fresh()->name);
    }

    public function test_seller_tidak_bisa_memindahkan_produk_ke_toko_lain_lewat_store_id(): void
    {
        $a = $this->seller('Toko A');
        $b = $this->seller('Toko B');

        $this->actingAs($a)->post('/admin/products', $this->productPayload(['store_id' => $b->store->id]))
            ->assertSessionHasErrors('store_id');
        $this->assertDatabaseCount('products', 0);
    }

    public function test_customer_tidak_bisa_lihat_pesanan_orang_lain(): void
    {
        $seller = $this->seller('Toko A');
        $owner = User::factory()->create(['role' => 'customer']);
        $other = User::factory()->create(['role' => 'customer']);
        $order = Transaction::create([
            'user_id' => $owner->id, 'store_id' => $seller->store->id, 'invoice_code' => 'INV-TEST-1',
            'total' => 10000, 'status' => Transaction::STATUSES[0],
        ]);

        $this->actingAs($other)->get("/pesanan/{$order->id}")->assertForbidden();
        $this->actingAs($owner)->get("/pesanan/{$order->id}")->assertOk();
    }

    public function test_register_tidak_bisa_set_role_atau_verifikasi_sendiri(): void
    {
        $this->post('/register', [
            'name' => 'Iseng', 'email' => 'iseng@test.id', 'password' => 'password123', 'password_confirmation' => 'password123',
            'account_type' => 'seller', 'role' => 'admin', 'is_verified' => 1,
            'store_name' => 'Toko Iseng', 'store_phone' => '08123456789', 'store_address' => 'Pemalang',
        ]);

        $user = User::where('email', 'iseng@test.id')->firstOrFail();
        $this->assertSame('seller', $user->role);
        $this->assertFalse((bool) $user->store->is_verified);
    }

    public function test_upload_php_dan_svg_ditolak(): void
    {
        Storage::fake('public');
        $seller = $this->seller('Toko A');
        $svg = UploadedFile::fake()->createWithContent('logo.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>');
        $php = UploadedFile::fake()->createWithContent('shell.php', '<?php system($_GET["c"]); ?>');
        $phpAsJpg = UploadedFile::fake()->createWithContent('shell.jpg', '<?php system($_GET["c"]); ?>');

        foreach ([$svg, $php, $phpAsJpg] as $file) {
            $this->actingAs($seller)->post('/admin/products', $this->productPayload(['image' => $file]))
                ->assertSessionHasErrors('image');
        }
        $this->assertDatabaseCount('products', 0);
        $this->assertEmpty(Storage::disk('public')->allFiles());
    }

    public function test_upload_gambar_asli_disimpan_dengan_nama_acak(): void
    {
        Storage::fake('public');
        $seller = $this->seller('Toko A');

        $this->actingAs($seller)->post('/admin/products', $this->productPayload([
            'image' => UploadedFile::fake()->image('../../evil.jpg', 400, 400),
        ]))->assertRedirect();

        $path = Product::firstOrFail()->image;
        $this->assertMatchesRegularExpression('#^products/[A-Za-z0-9]{40}\.jpg$#', $path);
        Storage::disk('public')->assertExists($path);
    }

    public function test_login_brute_force_dibatasi(): void
    {
        $user = User::factory()->create(['email' => 'korban@test.id']);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'korban@test.id', 'password' => 'salah'.$i]);
        }
        // Password benar pun ditolak selama masa tunggu
        $this->post('/login', ['email' => 'korban@test.id', 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->assertStringContainsString('Terlalu banyak percobaan login', session('errors')->first('email'));
        $this->assertGuest();
    }

    public function test_header_keamanan_terpasang(): void
    {
        $response = $this->get('/')->assertOk()
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Permissions-Policy', 'geolocation=(self), camera=(), microphone=()')
            ->assertHeaderMissing('Strict-Transport-Security');

        $csp = $response->headers->get('Content-Security-Policy');
        $this->assertStringContainsString("frame-ancestors 'self'", $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertMatchesRegularExpression("/script-src 'self' 'nonce-([A-Za-z0-9]{32})'/", $csp);
        preg_match("/'nonce-([A-Za-z0-9]{32})'/", $csp, $m);
        $response->assertSee('nonce="'.$m[1].'"', false);
        $this->assertStringNotContainsString("script-src 'self' 'unsafe-inline'", $csp);
    }

    public function test_hsts_hanya_saat_https(): void
    {
        $this->get('https://localhost/')->assertHeader('Strict-Transport-Security');
    }

    public function test_post_tanpa_token_csrf_ditolak(): void
    {
        // Testing environment mematikan CSRF; nyalakan lagi khusus untuk test ini
        $this->withMiddleware();
        $this->app['env'] = 'local';
        $response = $this->call('POST', '/login', ['email' => 'a@b.c', 'password' => 'x']);
        $this->assertSame(419, $response->getStatusCode());
    }
}
