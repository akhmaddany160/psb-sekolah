<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\StudentTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test unauthenticated redirects to login.
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get(route('student.pembayaran.formulir'));
        $response->assertRedirect(route('login'));

        $response2 = $this->get(route('student.pembayaran.daftar_ulang'));
        $response2->assertRedirect(route('login'));
    }

    /**
     * Test user without jenjang gets redirected to dashboard.
     */
    public function test_user_without_jenjang_redirected_to_dashboard(): void
    {
        $user = User::factory()->create([
            'jenjang' => null,
        ]);

        $response = $this->actingAs($user)->get(route('student.pembayaran.formulir'));
        $response->assertRedirect(route('dashboard'));

        $response2 = $this->actingAs($user)->get(route('student.pembayaran.daftar_ulang'));
        $response2->assertRedirect(route('dashboard'));
    }

    /**
     * Test that user can view Pembayaran Formulir and simulate payment.
     */
    public function test_user_can_view_formulir_payment_and_simulate(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMA',
            'pembayaran_formulir' => 'BELUM_BAYAR',
        ]);

        // 1. View payment page
        $response = $this->actingAs($user)->get(route('student.pembayaran.formulir'));
        $response->assertStatus(200);
        $response->assertSee('Pembayaran Formulir');
        $response->assertSee('Rp 150.000');
        $response->assertSee('Bayar via Simulator (Lunas)');

        // 2. Simulate payment
        $response2 = $this->actingAs($user)->post(route('student.pembayaran.formulir.simulate'));
        $response2->assertRedirect(route('student.pembayaran.formulir'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'pembayaran_formulir' => 'LUNAS',
        ]);
    }

    /**
     * Test that test route is locked until pembayaran_formulir is LUNAS.
     */
    public function test_test_route_is_locked_until_pembayaran_formulir_is_lunas(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMA',
            'pembayaran_formulir' => 'BELUM_BAYAR',
        ]);

        // Visiting test page should redirect to payment page
        $response = $this->actingAs($user)->get(route('student.test.show'));
        $response->assertRedirect(route('student.pembayaran.formulir'));
        $response->assertSessionHas('status');

        // Update payment status to LUNAS
        $user->pembayaran_formulir = 'LUNAS';
        $user->save();

        // Now visiting test page should load successfully
        $response2 = $this->actingAs($user)->get(route('student.test.show'));
        $response2->assertStatus(200);
        $response2->assertViewIs('student.test');
    }

    /**
     * Test that re-registration payment is locked until student passes the selection test.
     */
    public function test_reregistration_is_locked_until_passed_test(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMA',
            'pembayaran_formulir' => 'LUNAS',
        ]);

        // 1. Without test record, re-registration page is locked
        $response = $this->actingAs($user)->get(route('student.pembayaran.daftar_ulang'));
        $response->assertStatus(200);
        $response->assertSee('Langkah Belum Terbuka');
        $response->assertSee('Ujian Seleksi');

        // 2. With failed test record, re-registration page remains locked
        StudentTest::create([
            'user_id' => $user->id,
            'jenjang' => 'SMA',
            'score' => 50,
            'status' => 'TIDAK_LULUS',
            'completed_at' => now(),
        ]);

        $response2 = $this->actingAs($user)->get(route('student.pembayaran.daftar_ulang'));
        $response2->assertStatus(200);
        $response2->assertSee('Langkah Belum Terbuka');
    }

    /**
     * Test that passing re-registration payment shows correct invoice based on level and allows simulation.
     */
    public function test_passing_student_can_pay_reregistration_with_correct_amount(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMP', // PMC Home School (SD)
            'pembayaran_formulir' => 'LUNAS',
            'pembayaran_daftar_ulang' => 'BELUM_BAYAR',
        ]);

        StudentTest::create([
            'user_id' => $user->id,
            'jenjang' => 'SMP',
            'score' => 75,
            'status' => 'LULUS',
            'completed_at' => now(),
        ]);

        // 1. View payment page, should display Rp 1.500.000 for SMP
        $response = $this->actingAs($user)->get(route('student.pembayaran.daftar_ulang'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Ulang');
        $response->assertSee('Rp 1.500.000'); // SMP re-registration fee
        $response->assertSee('PMC Home School (SD)');

        // 2. Simulate successful payment
        $response2 = $this->actingAs($user)->post(route('student.pembayaran.daftar_ulang.simulate'));
        $response2->assertRedirect(route('student.pembayaran.daftar_ulang'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'pembayaran_daftar_ulang' => 'LUNAS',
        ]);
    }
}
