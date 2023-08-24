<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thumbnail>
 */
class ThumbnailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::fake('images');

        return [
            'title' =>  ucfirst(fake()->words(mt_rand(1, 2), true)),
            'path' => UploadedFile::fake()->image('avatar.jpg'),
            'thumbnail_path' => UploadedFile::fake()->image('avatar.jpg', 150, 150),
            'post_id' => Post::factory(),
        ];
    }
}
