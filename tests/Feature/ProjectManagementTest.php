<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_projects(): void
    {
        Project::factory()->create([
            'name' => 'Interview preparation',
            'description' => 'Learn the Laravel request lifecycle',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Interview preparation')
            ->assertSee('Learn the Laravel request lifecycle');
    }

    public function test_a_project_can_be_created(): void
    {
        $this->post('/projects', [
            'name' => 'Practice Laravel',
            'description' => 'Build a small application',
        ])->assertRedirect('/');

        $this->assertDatabaseHas('projects', [
            'name' => 'Practice Laravel',
            'description' => 'Build a small application',
            'is_completed' => false,
        ]);
    }

    public function test_project_name_is_required(): void
    {
        $this->from('/')
            ->post('/projects', ['name' => ''])
            ->assertRedirect('/')
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('projects', 0);
    }

    public function test_a_project_can_be_marked_completed(): void
    {
        $project = Project::factory()->create(['is_completed' => false]);

        $this->patch("/projects/{$project->id}/complete")
            ->assertRedirect('/');

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'is_completed' => true,
        ]);
    }
}
