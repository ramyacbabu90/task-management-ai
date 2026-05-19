<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Admin can do everything.
     */
    public function before(User $user)
    {
        if ($user->role->value === 'admin') {
            return true;
        }
    }

    /**
     * View any tasks.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * View specific task.
     */
    public function view(User $user, Task $task): bool
    {
        return $task->assigned_to === $user->id;
    }

    /**
     * Create task.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Update task.
     */
    public function update(User $user, Task $task): bool
    {
        return $task->assigned_to === $user->id;
    }

    /**
     * Delete task.
     */
    public function delete(User $user, Task $task): bool
    {
        return $task->assigned_to === $user->id;
    }
}