@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Create Task
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
<form action="{{ route('tasks.store') }}"
      method="POST"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf

    <div>
        <label class="block mb-1">Title</label>

        <input type="text"
               name="title"
               class="w-full border rounded p-2"
               required>
    </div>

    <div>
        <label class="block mb-1">Description</label>

        <textarea name="description"
                  class="w-full border rounded p-2"></textarea>
    </div>

    <div>
        <label class="block mb-1">Priority</label>

        <select name="priority"
                class="w-full border rounded p-2">

            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>

        </select>
    </div>

    <div>
        <label class="block mb-1">Status</label>

        <select name="status"
                class="w-full border rounded p-2">

            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>

        </select>
    </div>

    <div>
        <label class="block mb-1">Due Date</label>

        <input type="date"
               name="due_date"
               class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block mb-1">Assign User</label>

        <select name="assigned_to"
                class="w-full border rounded p-2">

            @foreach($users as $user)

                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>

            @endforeach

        </select>
    </div>

    <button type="submit" onclick="this.disabled=true; this.form.submit();"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Save Task

    </button>

</form>

@endsection