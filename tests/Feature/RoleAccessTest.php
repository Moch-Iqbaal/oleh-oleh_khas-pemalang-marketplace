<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_diarahkan_ke_login_saat_buka_admin(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_customer_tidak_boleh_masuk_panel_admin(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->get('/admin')->assertForbidden();
        $this->actingAs($customer)->get('/admin/products')->assertForbidden();
    }

    public function test_staff_boleh_kelola_produk_tapi_tidak_boleh_kelola_user(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->get('/admin/products')->assertOk();
        $this->actingAs($staff)->get('/admin/users')->assertForbidden();
    }

    public function test_admin_boleh_ubah_role_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($admin)->patch("/admin/users/{$user->id}/role", ['role' => 'staff'])
            ->assertRedirect();

        $this->assertSame('staff', $user->fresh()->role);
    }

    public function test_customer_tidak_bisa_lihat_pesanan_orang_lain(): void
    {
        $owner = User::factory()->create(['role' => 'customer']);
        $other = User::factory()->create(['role' => 'customer']);
        $order = Transaction::create([
            'user_id' => $owner->id, 'invoice_code' => 'INV-TEST-1', 'total' => 1000, 'status' => 'pending',
        ]);

        $this->actingAs($other)->get("/pesanan/{$order->id}")->assertForbidden();
        $this->actingAs($owner)->get("/pesanan/{$order->id}")->assertOk();
    }
}
