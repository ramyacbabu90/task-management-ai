@extends('layouts.app')

@section('page-title', 'Task Detail + AI Summary')

@section('content')

<div class="bg-white text-black rounded-3xl p-8 shadow-2xl">

    <!-- Header -->
    <div class="flex justify-between items-start mb-8">

        <div>

            <h2 class="text-4xl font-bold mb-4">
                {{ $task->title }}
            </h2>

            <div class="flex gap-4">

                <span class="
                    px-4 py-2 rounded-full text-sm font-semibold

                    @if($task->status->value === 'completed')
                        bg-green-100 text-green-700
                    @elseif($task->status->value === 'in_progress')
                        bg-yellow-100 text-yellow-700
                    @else
                        bg-gray-100 text-gray-700
                    @endif
                ">
                    {{ ucfirst(str_replace('_', ' ', $task->status->value)) }}
                </span>

                <span class="
                    px-4 py-2 rounded-full text-sm font-semibold text-white

                    @if($task->priority->value === 'high')
                        bg-red-500
                    @elseif($task->priority->value === 'medium')
                        bg-yellow-500
                    @else
                        bg-green-500
                    @endif
                ">
                    {{ ucfirst($task->priority->value) }}
                </span>

            </div>

        </div>

        <div class="text-gray-400 text-3xl">
            ⋯
        </div>

    </div>

    <!-- Task Content -->
    <div class="bg-gray-50 rounded-3xl p-6 mb-6">

        <h3 class="text-2xl font-bold mb-4">
            Description
        </h3>

        <div class="space-y-4 text-gray-700">

            <p>
                <strong>Assigned To:</strong>
                {{ $task->user?->name }}
            </p>

            <div class="bg-white border rounded-xl px-4 py-3">

                Due Date:
                {{ $task->due_date?->format('Y-m-d') }}

            </div>

            <p class="leading-relaxed">
                {{ $task->description }}
            </p>

        </div>

    </div>

    <!-- AI Summary -->
    <div class="bg-gray-50 rounded-3xl p-6 mb-6">

        <h3 class="text-2xl font-bold mb-4">
            AI-Generated Summary
        </h3>

        <div class="bg-white rounded-2xl p-5 border mb-4">

            <p class="text-gray-700 leading-relaxed">
                {{ $task->ai_summary ?? 'AI summary is being processed...' }}
            </p>

        </div>

        <div class="bg-white rounded-2xl p-5 border">

            <p class="text-lg">

                <strong>AI Suggested Priority:</strong>

                <span class="capitalize">
                    {{ $task->ai_priority ?? 'Pending' }}
                </span>

            </p>

        </div>

    </div>

    <!-- Actions -->
    <div class="flex justify-center gap-4">

        <a href="{{ route('tasks.edit', $task->id) }}"
           class="bg-blue-500 hover:bg-blue-600 transition text-white px-8 py-3 rounded-2xl font-semibold">

            Edit Task

        </a>

        <a href="{{ route('tasks.index') }}"
           class="bg-gray-200 hover:bg-gray-300 transition px-8 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

</div>

@endsection