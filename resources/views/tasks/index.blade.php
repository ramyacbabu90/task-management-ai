@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tasks</h1>

    <a href="{{ route('tasks.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        Create Task
    </a>
</div>

@if(session('success'))
    <div class="bg-green-200 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded shadow p-4">
<div class="overflow-x-auto">
    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Title</th>
                <th class="text-left p-2">Priority</th>
                <th class="text-left p-2">Status</th>
                <th class="text-left p-2">Assigned User</th>
                <th class="text-left p-2">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tasks as $task)
                <tr class="border-b">

                    <td class="p-2">
                        {{ $task->title }}
                    </td>

                    <td class="p-2">
                        {{ $task->priority->value }}
                    </td>

                    <td class="p-2">
                        {{ $task->status->value }}
                    </td>

                    <td class="p-2">
                        {{ $task->user->name }}
                    </td>

                    <td class="p-2 flex gap-2">

                        <a href="{{ route('tasks.show', $task->id) }}"
                           class="text-blue-500">
                            View
                        </a>

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="text-green-500">
                            Edit
                        </a>

                    </td>

                </tr>
            @empty

                <tr>
                    <td colspan="5" class="p-4 text-center">
                        No tasks found
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-4">
    {{ $tasks->links() }}
</div>
</div>
</div>

@endsection
@section('empty')
<tr>
    <td colspan="5" class="p-6 text-center text-gray-500">
        No tasks available
    </td>
</tr>
@endsection