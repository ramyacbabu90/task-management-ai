@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Edit Task
</h1>

@if ($errors->any())

    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">

        <ul class="list-disc ml-5">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<form action="{{ route('tasks.update', $task->id) }}"
      method="POST"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1">Title</label>

        <input type="text"
               name="title"
               value="{{ old('title', $task->title) }}"
               class="w-full border rounded p-2"
               required>
    </div>

    <div>
        <label class="block mb-1">Description</label>

        <textarea name="description"
                  class="w-full border rounded p-2">{{ old('description', $task->description) }}</textarea>
    </div>

    <div>
        <label class="block mb-1">Priority</label>

        <select name="priority"
                class="w-full border rounded p-2">

            <option value="low"
                {{ $task->priority->value === 'low' ? 'selected' : '' }}>
                Low
            </option>

            <option value="medium"
                {{ $task->priority->value === 'medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="high"
                {{ $task->priority->value === 'high' ? 'selected' : '' }}>
                High
            </option>

        </select>
    </div>

    <div>
        <label class="block mb-1">Status</label>

        <select name="status"
                class="w-full border rounded p-2">

            <option value="pending"
                {{ $task->status->value === 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="in_progress"
                {{ $task->status->value === 'in_progress' ? 'selected' : '' }}>
                In Progress
            </option>

            <option value="completed"
                {{ $task->status->value === 'completed' ? 'selected' : '' }}>
                Completed
            </option>

        </select>
    </div>

    <div>
        <label class="block mb-1">Due Date</label>

        <input type="date"
               name="due_date"
               value="{{ $task->due_date?->format('Y-m-d') }}"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block mb-1">Assign User</label>

        <select name="assigned_to"
                class="w-full border rounded p-2">

            @foreach($users as $user)

                <option value="{{ $user->id }}"
                    {{ $task->assigned_to == $user->id ? 'selected' : '' }}>

                    {{ $user->name }}

                </option>

            @endforeach

        </select>
    </div>

    <button type="submit" onclick="this.disabled=true; this.form.submit();"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Update Task

    </button>

</form>

@endsection