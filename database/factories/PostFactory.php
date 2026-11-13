<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
        'author_id' => \App\Models\Author::factory(),
        'title' => fake()->sentence(6),
        'category' => fake()->randomElement(Post::CATEGORIES),
        'body' => fake()->paragraphs(3, true),
        'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
    ];
}

public function draft(): static
{
    return $this->state(fn () => [
        'published_at' => null,
    ]);
}
}
