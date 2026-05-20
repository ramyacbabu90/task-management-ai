<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_edit_other_users_task(): void
    {
        $user1 = User::factory()->create();

        $user2 = User::factory()->create();

        $task = Task::factory()->create([
            'assigned_to' => $user1->id
        ]);

        $response = $this->actingAs($user2)
            ->get("/tasks/{$task->id}/edit");

        $response->assertNotFound();
    }
}