<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository,
        protected AIService $aiService
    ) {
    }

    public function getAllTasks(array $filters = [])
    {
        return $this->taskRepository->all($filters);
    }

    public function getTask($id)
    {
        return $this->taskRepository->find($id);
    }

    public function createTask(array $data)
    {
        return DB::transaction(function () use ($data) {

            $task = $this->taskRepository->create($data);

            $aiData = $this->aiService->generateSummary($task);

            return $this->taskRepository->update(
                $task->id,
                $aiData
            );
        });
    }

    public function updateTask($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $task = $this->taskRepository->update($id, $data);

            $aiData = $this->aiService->generateSummary($task);

            return $this->taskRepository->update(
                $task->id,
                $aiData
            );
        });
    }

    public function deleteTask($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function updateStatus($id, string $status)
    {
        return $this->taskRepository->update($id, [
            'status' => $status
        ]);
    }
}