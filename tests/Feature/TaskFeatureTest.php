<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_tasks(): void
    {
        $user = User::factory()->create();

        Task::factory()->count(3)->create([
            'assigned_to' => $user->id
        ]);

        $response = $this->actingAs($user)
            ->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_user_can_create_task(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/tasks', [
                'title' => 'Test Task',
                'description' => 'Test Description',
                'priority' => 'high',
                'status' => 'pending',
                'due_date' => now()->format('Y-m-d'),
                'assigned_to' => $user->id,
            ]);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task'
        ]);
    }

    public function test_guest_cannot_access_tasks(): void
    {
        $response = $this->get('/tasks');

        $response->assertRedirect('/login');
    }
}