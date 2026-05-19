@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">
        {{ $task->title }}
    </h1>

    <p class="mb-3">
        {{ $task->description }}
    </p>

    <div class="space-y-2">

        <p>
            <strong>Priority:</strong>
            {{ $task->priority->value }}
        </p>

        <p>
            <strong>Status:</strong>
            {{ $task->status->value }}
        </p>

        <p>
            <strong>AI Summary:</strong>
            {{ $task->ai_summary }}
        </p>

        <p>
            <strong>AI Priority:</strong>
            {{ $task->ai_priority }}
        </p>

    </div>

</div>

@endsection