<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalFlowsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_load_correctly(): void
    {
        // Setup initial Category to prevent welcome lists crashing
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/courses');
        $response->assertStatus(200);

        $response = $this->get('/articles');
        $response->assertStatus(200);
    }

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_student_can_access_dashboard(): void
    {
        $student = User::create([
            'name' => 'Jane Student',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        $response = $this->actingAs($student)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Master Admin',
            'email' => 'master@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello CodeSpire! This is a test message.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success');
    }
}
