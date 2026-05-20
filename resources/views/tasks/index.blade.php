@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('page-title', 'Task List')

@section('content')

@if(session('success'))

    <div class="bg-green-500 text-white px-4 py-3 rounded-xl mb-6">
        {{ session('success') }}
    </div>

@endif

<!-- Filter Section -->
    <div class="flex flex-wrap gap-4 mb-8">

        <form method="GET"action="{{ route('tasks.index') }}"class="flex flex-wrap gap-4 mb-8">

            <!-- Search -->
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search tasks..."
                class="bg-white text-black px-4 py-3 rounded-xl w-full md:w-64">

            <!-- Status -->
            <select name="status"
                    class="bg-white text-black px-4 py-3 rounded-xl">

                <option value="">All Status</option>

                <option value="pending"
                    @selected(request('status') === 'pending')>
                    Pending
                </option>

                <option value="in_progress"
                    @selected(request('status') === 'in_progress')>
                    In Progress
                </option>

                <option value="completed"
                    @selected(request('status') === 'completed')>
                    Completed
                </option>

            </select>

            <!-- Priority -->
            <select name="priority"
                    class="bg-white text-black px-4 py-3 rounded-xl">

                <option value="">All Priority</option>

                <option value="low"
                    @selected(request('priority') === 'low')>
                    Low
                </option>

                <option value="medium"
                    @selected(request('priority') === 'medium')>
                    Medium
                </option>

                <option value="high"
                    @selected(request('priority') === 'high')>
                    High
                </option>

            </select>

            <!-- Users -->
            @if(auth()->user()->role->value === 'admin')

                <select name="assigned_to"
                        class="bg-white text-black px-4 py-3 rounded-xl">

                    <option value="">
                        All Users
                    </option>

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                            @selected(request('assigned_to') == $user->id)>

                            {{ $user->name }}

                        </option>

                    @endforeach

                </select>

            @endif

            <!-- Button -->
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 transition px-6 py-3 rounded-xl font-semibold">

                Filter

            </button>
            <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 transition px-6 py-3 rounded-xl font-semibold text-black">
             Reset 
            </a>

        </form>

    </div>
            <!-- end filter section -->


<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @forelse($tasks as $task)

        <div class="bg-white text-black rounded-3xl p-6 shadow-2xl relative">

            <!-- Top Row -->
            <div class="flex justify-between items-start mb-6">

                <div class="flex items-center gap-3">

                    <span class="w-4 h-4 bg-blue-500 rounded-full"></span>

                    <span class="text-sm bg-gray-100 px-3 py-1 rounded-full font-medium">

                        {{ ucfirst(str_replace('_', ' ', $task->status->value)) }}

                    </span>

                </div>

                <button class="text-gray-400 text-xl">
                    ⋯
                </button>

            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold mb-4 leading-tight">

                {{ $task->title }}

            </h2>

            <!-- Tags -->
            <div class="flex gap-2 mb-5">

                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">

                    Status

                </span>

                <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">

                    Priority: {{ ucfirst($task->priority->value) }}

                </span>

            </div>

            <!-- Description -->
            <div class="text-gray-600 text-sm mb-5 leading-relaxed min-h-[70px]">

                {{ Str::limit($task->description, 100) }}

            </div>

            <!-- Meta -->
            <div class="space-y-2 text-sm text-gray-500 mb-6">

                <p>
                    Assigned: {{ $task->user?->name }}
                </p>

                <p>
                    Due: {{ $task->due_date?->format('Y-m-d') }}
                </p>

                <p class="text-blue-500 font-semibold capitalize">

                    {{ $task->ai_priority }}

                </p>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('tasks.edit', $task->id) }}"
                   class="bg-gray-200 hover:bg-gray-300 transition px-4 py-2 rounded-xl font-medium text-sm">

                    Edit

                </a>

                <a href="{{ route('tasks.show', $task->id) }}"
                   class="bg-blue-500 hover:bg-blue-600 transition text-white px-4 py-2 rounded-xl font-medium text-sm">

                    View

                </a>

            </div>

        </div>

    @empty

        <div class="col-span-2 bg-white rounded-3xl p-10 text-center text-gray-500">

            No tasks available

        </div>

    @endforelse

</div>

<!-- Pagination -->
<div class="mt-8">

    <!-- {{ $tasks->links() }} -->
    {{ $tasks->appends(request()->query())->links() }}
</div>

@endsection