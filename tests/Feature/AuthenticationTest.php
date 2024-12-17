<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test correct login credentials.
     */
    public function test_correct_login_credentials(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = 'password')]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test incorrect login credentials.
     */
    public function test_incorrect_login_credentials(): void
    {
        $user = User::factory()->create(['password' => bcrypt($password = 'password')]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
