<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement([
                'low',
                'medium',
                'high'
            ]),
            'status' => fake()->randomElement([
                'pending',
                'in_progress',
                'completed'
            ]),
            'due_date' => fake()->date(),
            'assigned_to' => 1,
        ];
    }
}