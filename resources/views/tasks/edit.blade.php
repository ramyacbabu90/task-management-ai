@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Edit Task
</h1>

<form action="{{ route('tasks.update', $task->id) }}"
      method="POST"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1">Title</label>

        <input type="text"
               name="title"
               value="{{ $task->title }}"
               class="w-full border rounded p-2"
               required>
    </div>

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Update Task

    </button>

</form>

@endsection