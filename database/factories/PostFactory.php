<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id, // Create a user for the post
            'category' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'posts'),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'tags' => json_encode($this->faker->words(3)), // Store tags as a JSON array
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}
