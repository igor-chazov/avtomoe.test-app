<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['фантастика', 'ужасы', 'боевики', 'Научная литература', 'художественная литература', 'седан', 'минивэн', 'авторское ТВ'];

        foreach ($arr as $item) {
            Tag::create([
                'title' => $item,
            ]);
        }
    }
}
