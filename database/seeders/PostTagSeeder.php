<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Post::all() as $post) {
            foreach (Tag::all() as $tag) {

                if (rand(1, 8) >= 4) {
                    $tag->posts()->attach($post->id);
                }

            }
        }
    }
}
