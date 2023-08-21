<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            foreach (Post::all() as $post) {
                Comment::factory()
                    ->count(1)
                    ->create(['post_id' => $post, 'user_id' => $user]);
            }
        }
    }
}
