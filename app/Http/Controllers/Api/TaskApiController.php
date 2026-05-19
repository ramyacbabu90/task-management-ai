<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskApiController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected TaskService $taskService
    ) {
    }

    /**
     * GET /api/tasks
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Task::class);

        $tasks = $this->taskService->getAllTasks();

        return response()->json([
            'success' => true,
            'message' => 'Tasks fetched successfully',
            'data' => TaskResource::collection($tasks),
        ], 200);
    }

    /**
     * POST /api/tasks
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $this->authorize('create', Task::class);

        $task = $this->taskService->createTask(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => new TaskResource($task),
        ], 201);
    }

    /**
     * PATCH /api/tasks/{id}/status
     */
    public function updateStatus(Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        request()->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $updatedTask = $this->taskService->updateStatus(
            $task->id,
            request('status')
        );

        return response()->json([
            'success' => true,
            'message' => 'Task status updated successfully',
            'data' => new TaskResource($updatedTask),
        ], 200);
    }

    /**
     * GET /api/tasks/{id}/ai-summary
     */
    public function aiSummary(Task $task): JsonResponse
    {
        $this->authorize('view', $task);

        return response()->json([
            'success' => true,
            'message' => 'AI summary fetched successfully',
            'data' => [
                'task_id' => $task->id,
                'ai_summary' => $task->ai_summary,
                'ai_priority' => $task->ai_priority,
            ]
        ], 200);
    }
}