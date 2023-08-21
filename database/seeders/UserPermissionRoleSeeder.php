<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', 'admin')->first();
        $banned = Role::where('slug', 'banned')->first();
        $developer = Role::where('slug', 'web-developer')->first();
        $manager = Role::where('slug', 'project-manager')->first();
        $createTasks = Permission::where('slug', 'create-tasks')->first();
        $manageUsers = Permission::where('slug', 'manage-users')->first();

        User::factory(4)->create();

        $user1 = User::find(1);
        $user1->roles()->attach($admin->id);
        $user1->roles()->attach($developer->id);
        $user1->permissions()->attach($createTasks->id);

        $user2 = User::find(2);
        $user2->roles()->attach($manager->id);
        $user2->roles()->attach($banned->id);
        $user2->permissions()->attach($manageUsers->id);
    }
}
