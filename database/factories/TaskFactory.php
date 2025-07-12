<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => rand(1, 5),
            'assigned_user_id' => rand(1, 10),
            'title' => fake()->sentence(3),
            'description' => fake()->text(),
            'status' => Arr::random(['in progress', 'completed', 'canceled']),
            'priority' => Arr::random(['low', 'medium', 'high']),
            'deadline' => fake()->dateTime()
        ];
    }
}
