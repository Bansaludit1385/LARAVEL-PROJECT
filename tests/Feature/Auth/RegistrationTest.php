<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'male',
            'age' => 25,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_registration_generates_gender_and_age_specific_avatar(): void
    {
        // 1. Male User
        $this->post('/register', [
            'name' => 'Little Timmy',
            'email' => 'timmy@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'male',
            'age' => 8,
        ]);
        $userTimmy = \App\Models\User::where('email', 'timmy@example.com')->first();
        $this->assertNotNull($userTimmy);
        $this->assertEquals('https://api.dicebear.com/7.x/avataaars/svg?seed=Jack', $userTimmy->avatar);

        // Logout
        \Illuminate\Support\Facades\Auth::logout();

        // 2. Female User
        $this->post('/register', [
            'name' => 'Grandma Sarah',
            'email' => 'sarah@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'female',
            'age' => 72,
        ]);
        $userSarah = \App\Models\User::where('email', 'sarah@example.com')->first();
        $this->assertNotNull($userSarah);
        $this->assertEquals('https://api.dicebear.com/7.x/avataaars/svg?seed=Lily', $userSarah->avatar);
    }

    public function test_new_user_can_register_with_custom_selected_avatar(): void
    {
        $customAvatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=selected-test-seed&top=shortHairSides';
        
        $response = $this->post('/register', [
            'name' => 'Custom Avatar User',
            'email' => 'custom_avatar@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'male',
            'age' => 25,
            'selected_avatar' => $customAvatar,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $user = \App\Models\User::where('email', 'custom_avatar@example.com')->first();
        $this->assertEquals($customAvatar, $user->avatar);
    }
}
