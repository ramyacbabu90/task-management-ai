<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {
    }

    public function index()
    {
        $this->authorize('viewAny', Task::class);

        $filters = request()->only([
            'search',
            'status',
            'priority',
            'assigned_to'
        ]);

        $tasks = $this->taskService->getAllTasks($filters);
        $users = User::all();

        return view('tasks.index', compact(
            'tasks',
            'users'
        ));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        $users = User::all();
        
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'priority' => 'required',
        //     'status' => 'required',
        //     'due_date' => 'nullable|date',
        //     'assigned_to' => 'required|exists:users,id',
        // ]);

        $this->taskService->createTask($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    
    public function show($id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        
        $task = $this->taskService->getTask($id);
        $this->authorize('update', $task);
        $users = User::all();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $validated = $request->validated();
        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'priority' => 'required',
        //     'status' => 'required',
        //     'due_date' => 'nullable|date',
        //     'assigned_to' => 'required|exists:users,id',
        // ]);

        $this->taskService->updateTask($id, $validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('delete', $task);

        $this->taskService->deleteTask($id);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }
}