<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Иван',
            'last_name' => 'Соколов',
            'birthday' => fake()->dateTime(),
            'email' => 'ivan.sokolov@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret!'),
        ]);

        User::factory(4)->create();
    }
}
