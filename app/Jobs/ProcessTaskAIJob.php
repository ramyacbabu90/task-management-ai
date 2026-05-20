<?php

namespace App\Jobs;

use App\Models\Task;
use App\Services\AIService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessTaskAIJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public function __construct(
        protected Task $task
    ) {
    }

    public function handle(AIService $aiService): void
    {
        $aiData = $aiService->generateSummary($this->task);

        $this->task->update($aiData);
    }
}