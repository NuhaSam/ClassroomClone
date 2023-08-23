<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classwork>
 */
class ClassworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'type' => 'assignment',
            'status' => 'published',
            'user_id'=> 6,
            'topic_id'=> 1,
            'classroom_id'=>13
        ];
    }
}
