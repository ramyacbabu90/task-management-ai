<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Services\AIService;

class AIServiceTest extends TestCase
{
    public function test_ai_service_returns_summary(): void
    {
        $task = new Task([
            'title' => 'Server issue',
            'description' => 'Production server is down',
            'priority' => 'high',
        ]);

        $service = new AIService();

        $result = $service->generateSummary($task);

        $this->assertArrayHasKey('ai_summary', $result);

        $this->assertArrayHasKey('ai_priority', $result);
    }
}