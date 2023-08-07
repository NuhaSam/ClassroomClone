<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' =>Str::random(8),
            'section' => fake()->text(10),
            'subject' => fake()->text(10),
            'room' => 'R44',
            'user_id' => 6,
            'status' => 'active',
            'created_at' =>date('Y-m-d'),
            'updated_at' =>date('Y-m-d'),
        ];
    } // DONE.
}
