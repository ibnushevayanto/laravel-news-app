<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            ['name' => 'Science', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Politics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Crime', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Entertaiment', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
