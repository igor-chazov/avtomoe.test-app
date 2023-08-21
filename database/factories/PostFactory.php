<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'title' => ucfirst(fake()->words(mt_rand(1, 3), true)),
            'description' => fake()->words(10, true),
            'content' => fake()->text(500),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
