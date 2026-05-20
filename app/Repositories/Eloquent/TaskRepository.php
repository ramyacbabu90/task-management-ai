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

        /**
         * Restrict non-admin users
         */
        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        /**
         * Search Filter
         */
        if (!empty($filters['search'])) {

            $query->where(function ($q) use ($filters) {

                $q->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%');

            });
        }

        /**
         * Status Filter
         */
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        /**
         * Priority Filter
         */
        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        /**
         * Assigned User Filter
         */
        if (!empty($filters['assigned_to'])) {
            $query->where('assigned_to', $filters['assigned_to']);
        }

        /**
         * Cache Key
         */
        $cacheKey = 'tasks_' . auth()->id() . '_' . md5(json_encode($filters));

        return Cache::remember(
            $cacheKey,
            60,
            fn () => $query->latest()->paginate(10)
        );
    }

//    public function all(array $filters = [])
//     {
//         $query = Task::query()->with('user');

//         if (auth()->user()->role->value !== 'admin') {
//             $query->where('assigned_to', auth()->id());
//         }

//         // return $query
//         //     ->latest()
//         //     ->paginate(10);

//         return Cache::remember('tasks_' . auth()->id(),60,
//             fn () => $query
//                 ->latest()
//                 ->paginate(10)
//         );
//     }

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
       return Task::destroy($id);
    }


}