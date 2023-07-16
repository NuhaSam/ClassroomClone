<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => fake()->name(),
            // 'email' => fake()->email(),
            // 'email_verified_at' =>date('Y-m-d'),
            // 'password' => "H('n123$')",//'n123$',
            // 'remember_token' => 'null', 
            // 'created_at' =>date('Y-m-d'),
            // 'updated_at' =>date('Y-m-d'),
        ];
    }
}
