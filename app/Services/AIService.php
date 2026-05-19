<?php

namespace App\Services;

use App\Models\Task;

class AIService
{
    public function generateSummary(Task $task): array
    {
        /**
         * MOCK AI RESPONSE
         * Later we can integrate Gemini/OpenAI
         */

        $summary = "Task '{$task->title}' requires attention with {$task->priority->value} priority.";

        $aiPriority = match ($task->priority->value) {
            'high' => 'high',
            'medium' => 'medium',
            default => 'low',
        };

        return [
            'ai_summary' => $summary,
            'ai_priority' => $aiPriority,
        ];
    }
}