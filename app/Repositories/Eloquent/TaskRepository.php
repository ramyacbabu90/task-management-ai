<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
   public function all(array $filters = [])
    {
        $query = Task::query()->with('user');

        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        return $query
            ->latest()
            ->paginate(10);
    }

    public function find($id)
    {
        $query = Task::with('user');

        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        return $query->findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = $this->find($id);

        $task->update($data);

        return $task->refresh();
    }

    public function delete($id)
    {
        $task = $this->find($id);

        return $task->delete();
    }
}