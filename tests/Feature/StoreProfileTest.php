<?php

namespace Tests\Feature;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreProfileTest extends TestCase
{
    use RefreshDatabase;

    private function seller(): User
    {
        $user = User::factory()->create(['role' => 'seller']);
        Store::create([
            'user_id' => $user->id, 'name' => 'Toko A', 'slug' => 'toko-a',
            'address' => 'Pemalang', 'phone' => '08123456789', 'is_verified' => true,
        ]);

        return $user->fresh();
    }

    private function payload(array $extra = []): array
    {
        return $extra + ['name' => 'Toko A', 'address' => 'Kec. Taman, Pemalang', 'phone' => '08123456789'];
    }

    public function test_seller_bisa_simpan_koordinat_dan_foto_toko(): void
    {
        Storage::fake('public');
        $seller = $this->seller();

        $this->actingAs($seller)->put('/admin/toko-saya', $this->payload([
            'latitude' => '-6.9013234', 'longitude' => '109.4057555',
            'photo' => UploadedFile::fake()->image('toko.jpg', 800, 600),
        ]))->assertRedirect()->assertSessionHasNoErrors();

        $store = $seller->store->fresh();
        $this->assertEqualsWithDelta(-6.9013234, $store->latitude, 0.0000001);
        $this->assertEqualsWithDelta(109.4057555, $store->longitude, 0.0000001);
        Storage::disk('public')->assertExists($store->photo);
    }

    public function test_koordinat_di_luar_rentang_ditolak(): void
    {
        $seller = $this->seller();

        $this->actingAs($seller)->put('/admin/toko-saya', $this->payload(['latitude' => '91', 'longitude' => '181']))
            ->assertSessionHasErrors(['latitude', 'longitude']);

        // Latitude tanpa longitude juga ditolak
        $this->actingAs($seller)->put('/admin/toko-saya', $this->payload(['latitude' => '-6.9']))
            ->assertSessionHasErrors('longitude');
    }

    public function test_foto_toko_harus_gambar(): void
    {
        $seller = $this->seller();

        $this->actingAs($seller)->put('/admin/toko-saya', $this->payload([
            'photo' => UploadedFile::fake()->create('virus.php', 10, 'application/x-php'),
        ]))->assertSessionHasErrors('photo');
    }

    public function test_halaman_toko_menampilkan_peta_dan_link_google_maps(): void
    {
        $seller = $this->seller();
        $seller->store->update(['place_name' => 'Pasar Moga', 'latitude' => -7.1235743, 'longitude' => 109.2463483]);

        $this->get('/toko/toko-a')->assertOk()
            ->assertSee('openstreetmap.org/export/embed.html', false)
            ->assertSee('https://www.google.com/maps/search/?api=1&amp;query=Pasar%20Moga%2C%20Pemalang', false);
    }
}
