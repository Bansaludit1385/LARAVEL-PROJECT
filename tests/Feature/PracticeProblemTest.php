<?php

namespace Tests\Feature;

use App\Models\PracticeProblem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PracticeProblemTest extends TestCase
{
    use RefreshDatabase;

    public function test_practice_index_page_loads_correctly(): void
    {
        $response = $this->get('/practice');
        $response->assertStatus(200);
        $response->assertSee('Practice Arena');
    }

    public function test_practice_show_page_loads_correctly(): void
    {
        $problem = PracticeProblem::create([
            'title' => 'Sample Problem',
            'slug' => 'sample-problem',
            'difficulty' => 'easy',
            'category' => 'Array',
            'description' => 'Test description',
            'starter_code_py' => 'pass',
            'starter_code_cpp' => '// cpp',
            'starter_code_java' => '// java',
        ]);

        $response = $this->get('/practice/sample-problem');
        $response->assertStatus(200);
        $response->assertSee('Sample Problem');
        $response->assertSee('Test description');
    }

    public function test_practice_search_and_difficulty_filters(): void
    {
        PracticeProblem::create([
            'title' => 'Easy Two Sum',
            'slug' => 'easy-two-sum',
            'difficulty' => 'easy',
            'category' => 'Array',
            'description' => 'Two Sum details',
        ]);

        PracticeProblem::create([
            'title' => 'Hard Array Problem',
            'slug' => 'hard-array-problem',
            'difficulty' => 'hard',
            'category' => 'Array',
            'description' => 'Hard details',
        ]);

        // Filter by easy
        $response = $this->get('/practice?difficulty=easy');
        $response->assertStatus(200);
        $response->assertSee('Easy Two Sum');
        $response->assertDontSee('Hard Array Problem');

        // Filter by hard
        $response = $this->get('/practice?difficulty=hard');
        $response->assertStatus(200);
        $response->assertSee('Hard Array Problem');
        $response->assertDontSee('Easy Two Sum');

        // Search by keyword
        $response = $this->get('/practice?search=Easy');
        $response->assertStatus(200);
        $response->assertSee('Easy Two Sum');
        $response->assertDontSee('Hard Array Problem');
    }
}
