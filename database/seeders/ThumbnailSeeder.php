<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Thumbnail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Post::all() as $post) {
            Thumbnail::factory()
                ->count(1)
                ->create(['post_id' => $post]);
        }
    }
}
