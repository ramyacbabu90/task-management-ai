@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500 text-sm">Total Tasks</h2>

        <p class="text-3xl font-bold mt-2">
            {{ $stats['total_tasks'] }}
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500 text-sm">Completed Tasks</h2>

        <p class="text-3xl font-bold mt-2 text-green-600">
            {{ $stats['completed_tasks'] }}
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500 text-sm">Pending Tasks</h2>

        <p class="text-3xl font-bold mt-2 text-yellow-600">
            {{ $stats['pending_tasks'] }}
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500 text-sm">High Priority</h2>

        <p class="text-3xl font-bold mt-2 text-red-600">
            {{ $stats['high_priority_tasks'] }}
        </p>
    </div>

</div>

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-semibold mb-6">
        Task Status Analytics
    </h2>

    <canvas id="taskChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document.getElementById('taskChart');

    new Chart(ctx, {
        type: 'bar',

        data: {
            labels: [
                'Pending',
                'In Progress',
                'Completed'
            ],

            datasets: [{
                label: 'Tasks',

                data: [
                    {{ $chartData['pending'] }},
                    {{ $chartData['in_progress'] }},
                    {{ $chartData['completed'] }}
                ],

                borderWidth: 1
            }]
        },

        options: {
            responsive: true,
        }
    });

</script>

@endsection