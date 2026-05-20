<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    public function generateSummary(Task $task): array
    {
        try {

            $prompt = "
                Analyze the following task.

                Return:
                1. A short professional summary
                

                Task Title:
                {$task->title}

                Task Description:
                {$task->description}

                Response format:
                {
                  \"summary\": \"...\",
                  \"priority\": \"high\"
                }
            ";

            $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post(
                    'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash-lite:generateContent?key=' . env('GEMINI_API_KEY'),
                    [
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => $prompt
                                    ]
                                ]
                            ]
                        ]
                    ]
                );

            $data = $response->json();
            // dd($response->json());
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$text) {
                throw new \Exception('Invalid AI response');
            }

            /**
             * Remove markdown formatting if Gemini returns ```json
             */
            $text = str_replace(['```json', '```'], '', $text);

            $decoded = json_decode(trim($text), true);

            if (!$decoded) {
                throw new \Exception('Failed to decode AI JSON');
            }

            return [
                'ai_summary' => $decoded['summary'] ?? 'No summary generated',
                'ai_priority' => $decoded['priority'] ?? 'medium',
            ];

        } catch (\Exception $e) {

            Log::error('AI Summary Error: ' . $e->getMessage());

            /**
             * Fallback mock response
             */
            return [
                'ai_summary' =>
                    "AI summary unavailable currently for '{$task->title}'",

                'ai_priority' =>
                    $task->priority->value ?? 'medium',
            ];
        }
    }
}