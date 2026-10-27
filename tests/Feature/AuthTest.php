<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_membuat_user_dengan_role_customer(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'account_type' => 'customer',
            'role' => 'admin', // harus diabaikan
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'budi@example.com', 'role' => 'customer']);
    }

    public function test_register_tidak_bisa_memilih_role_admin(): void
    {
        $this->post('/register', [
            'name' => 'Hacker', 'email' => 'h@example.com',
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
            'account_type' => 'admin',
        ])->assertSessionHasErrors('account_type');

        $this->assertDatabaseMissing('users', ['email' => 'h@example.com']);
    }

    public function test_daftar_sebagai_penjual_membuat_toko_belum_terverifikasi(): void
    {
        $this->post('/register', [
            'name' => 'Bu Ani', 'email' => 'ani@example.com',
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
            'account_type' => 'seller',
            'store_name' => 'Keripik Bu Ani', 'store_phone' => '08123456789', 'store_address' => 'Kec. Taman, Pemalang',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('users', ['email' => 'ani@example.com', 'role' => 'seller']);
        $this->assertDatabaseHas('stores', ['name' => 'Keripik Bu Ani', 'is_verified' => false]);
    }

    public function test_daftar_penjual_tanpa_data_toko_ditolak(): void
    {
        $this->post('/register', [
            'name' => 'Bu Ani', 'email' => 'ani@example.com',
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
            'account_type' => 'seller',
        ])->assertSessionHasErrors(['store_name', 'store_phone', 'store_address']);
    }

    public function test_login_dengan_password_benar(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123', 'role' => 'customer']);

        $this->post('/login', ['email' => $user->email, 'password' => 'rahasia123'])
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_dengan_password_salah_ditolak(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        $this->post('/login', ['email' => $user->email, 'password' => 'salah'])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_dibatasi_setelah_5_kali_gagal(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => $user->email, 'password' => 'salah']);
        }

        // Percobaan ke-6 tetap ditolak walau password benar
        $this->post('/login', ['email' => $user->email, 'password' => 'rahasia123'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout')->assertRedirect(route('home'));
        $this->assertGuest();
    }
}
