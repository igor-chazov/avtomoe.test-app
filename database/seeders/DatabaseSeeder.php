<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->command->info(__('seeder.user_table'));

        $this->call(PostSeeder::class);
        $this->command->info(__('seeder.post_table'));

        $this->call(CommentSeeder::class);
        $this->command->info(__('seeder.comment_table'));

        $this->call( CategorySeeder::class);
        $this->command->info(__('seeder.category_table'));

        $this->call( TagSeeder::class);
        $this->command->info(__('seeder.tag_table'));

        $this->call(  ThumbnailSeeder::class);
        $this->command->info(__('seeder.thumbnail_table'));

        $this->call(  PostTagSeeder::class);
        $this->command->info(__('seeder.post_tag_table'));

        $this->call(  PermissionSeeder::class);
        $this->command->info(__('seeder.permission_table'));

        $this->call(  RoleSeeder::class);
        $this->command->info(__('seeder.role_table'));

        $this->call(  UserPermissionRoleSeeder::class);
        $this->command->info(__('seeder.user_permission_role_table'));
    }
}
