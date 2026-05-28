<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\StudentTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that unauthenticated users are redirected to login.
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get(route('student.test.show'));
        $response->assertRedirect(route('login'));

        $response2 = $this->get(route('student.test.results'));
        $response2->assertRedirect(route('login'));
    }

    /**
     * Test that user without jenjang gets redirected to dashboard.
     */
    public function test_user_without_jenjang_redirected_to_dashboard(): void
    {
        $user = User::factory()->create([
            'jenjang' => null,
        ]);

        $response = $this->actingAs($user)->get(route('student.test.show'));
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('status');
    }

    /**
     * Test that user with jenjang can view the selection test.
     */
    public function test_user_with_jenjang_can_view_test(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMA',
        ]);

        $response = $this->actingAs($user)->get(route('student.test.show'));
        $response->assertStatus(200);
        $response->assertViewIs('student.test');
        $response->assertSee('Test Seleksi Online');
        $response->assertSee('Al-Bayan School (SMP/SMA)');
        $response->assertSee('KAKAK : ADIK = BERUANG : ...'); // SMA question
    }

    /**
     * Test that correct answers result in passing score (LULUS).
     */
    public function test_submitting_correct_answers_results_in_lulus(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMA',
        ]);

        $answers = [
            'q1' => 'C', // Correct for Q1 SMA
            'q2' => 'C', // Correct for Q2 SMA
            'q3' => 'A', // Correct for Q3 SMA
            'q4' => 'B', // Correct for Q4 SMA
        ];

        $response = $this->actingAs($user)->post(route('student.test.submit'), $answers);
        $response->assertRedirect(route('student.test.results'));

        $this->assertDatabaseHas('student_tests', [
            'user_id' => $user->id,
            'jenjang' => 'SMA',
            'score' => 100,
            'status' => 'LULUS',
        ]);
    }

    /**
     * Test that incorrect answers result in failing score (TIDAK_LULUS).
     */
    public function test_submitting_incorrect_answers_results_in_tidak_lulus(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SD',
        ]);

        // SD questions correct are: 1->B, 2->B, 3->B, 4->C.
        // Let's answer only 1 correct (25 points).
        $answers = [
            'q1' => 'B', // Correct
            'q2' => 'A', // Wrong
            'q3' => 'A', // Wrong
            'q4' => 'A', // Wrong
        ];

        $response = $this->actingAs($user)->post(route('student.test.submit'), $answers);
        $response->assertRedirect(route('student.test.results'));

        $this->assertDatabaseHas('student_tests', [
            'user_id' => $user->id,
            'jenjang' => 'SD',
            'score' => 25,
            'status' => 'TIDAK_LULUS',
        ]);
    }

    /**
     * Test that visiting results page before test redirects to test page.
     */
    public function test_visiting_results_before_test_redirects_to_test(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMP',
        ]);

        $response = $this->actingAs($user)->get(route('student.test.results'));
        $response->assertRedirect(route('student.test.show'));
        $response->assertSessionHas('status');
    }

    /**
     * Test that after completing the test, visiting the test page redirects to results.
     */
    public function test_visiting_test_after_completion_redirects_to_results(): void
    {
        $user = User::factory()->create([
            'jenjang' => 'SMP',
        ]);

        StudentTest::create([
            'user_id' => $user->id,
            'jenjang' => 'SMP',
            'score' => 75,
            'status' => 'LULUS',
            'answers' => ['q1' => 'B', 'q2' => 'A', 'q3' => 'C', 'q4' => 'B'],
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('student.test.show'));
        $response->assertRedirect(route('student.test.results'));
    }
}
