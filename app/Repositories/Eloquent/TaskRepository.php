<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class TaskRepository implements TaskRepositoryInterface
{
   public function all(array $filters = [])
    {
        $query = Task::query()->with('user');

        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        // return $query
        //     ->latest()
        //     ->paginate(10);

        return Cache::remember('tasks_' . auth()->id(),60,
            fn () => $query
                ->latest()
                ->paginate(10)
        );
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
        $task = Task::create($data);

        Cache::forget('tasks_' . auth()->id());

        return $task;
    }

    public function update($id, array $data)
    {
        $task = $this->find($id);

        $task->update($data);
        Cache::forget('tasks_' . auth()->id());
        return $task->refresh();
    }

    public function delete($id)
    {
        $task = $this->find($id);
        Cache::forget('tasks_' . auth()->id());
        return $task->delete();
    }
}