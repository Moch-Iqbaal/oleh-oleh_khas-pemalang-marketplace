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
            'role' => 'admin', // harus diabaikan
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'budi@example.com', 'role' => 'customer']);
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
