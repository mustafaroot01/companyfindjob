<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_as_candidate(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Candidate',
            'email' => 'candidate@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'candidate',
        ]);

        $this->assertAuthenticated();
        
        $user = User::where('email', 'candidate@example.com')->first();
        $this->assertEquals('candidate', $user->role);
        $this->assertNull($user->company_name);
        
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_new_users_can_register_as_employer(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Employer',
            'email' => 'employer@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'employer',
            'company_name' => 'Test Company Inc.',
        ]);

        $this->assertAuthenticated();

        $user = User::where('email', 'employer@example.com')->first();
        $this->assertEquals('employer', $user->role);
        $this->assertEquals('Test Company Inc.', $user->company_name);

        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
