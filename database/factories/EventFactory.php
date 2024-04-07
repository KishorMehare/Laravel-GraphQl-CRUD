<?php

namespace Database\Factories;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->randomElement(['start', 'next','stop']),
            'timestamp'=> strtotime(now()),
            'user_id'=> rand(1,9),
            'activity_id'=> fake()->randomElement(['Math-1', 'Math-2','Math-3'])
        ];
    }
}
