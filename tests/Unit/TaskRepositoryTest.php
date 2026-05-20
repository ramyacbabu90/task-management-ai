<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\Eloquent\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_repository_can_create_task(): void
    {
        $user = User::factory()->create();

        $repository = new TaskRepository();

        $task = $repository->create([
            'title' => 'Repository Task',
            'description' => 'Repository Test',
            'priority' => 'medium',
            'status' => 'pending',
            'assigned_to' => $user->id,
        ]);

        $this->assertEquals(
            'Repository Task',
            $task->title
        );
    }
}