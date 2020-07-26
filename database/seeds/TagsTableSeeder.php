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
        $tag = collect([
            ['name' => 'Science'],
            ['name' => 'Politics'],
            ['name' => 'Sports'],
            ['name' => 'Technology'],
            ['name' => 'Crime'],
            ['name' => 'Entertaiment'],
            ['name' => 'Economy']
        ]);

        $tag->each(function ($tagName) {
            Tag::create($tagName);
        });
    }
}
