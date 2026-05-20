<?php

namespace App\Services;

use App\Models\Task;

class DashboardService
{
    public function getStatistics(): array
    {
        $query = Task::query();

        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        return [
            'total_tasks' => (clone $query)->count(),

            'completed_tasks' => (clone $query)
                ->where('status', 'completed')
                ->count(),

            'pending_tasks' => (clone $query)
                ->where('status', 'pending')
                ->count(),

            'high_priority_tasks' => (clone $query)
                ->where('priority', 'high')
                ->count(),
        ];
    }

    public function getChartData(): array
    {
        $query = Task::query();

        if (auth()->user()->role->value !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        return [
            'pending' => (clone $query)
                ->where('status', 'pending')
                ->count(),

            'in_progress' => (clone $query)
                ->where('status', 'in_progress')
                ->count(),

            'completed' => (clone $query)
                ->where('status', 'completed')
                ->count(),
        ];
    }
}