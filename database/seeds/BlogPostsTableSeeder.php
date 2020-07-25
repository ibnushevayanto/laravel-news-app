<?php

use Illuminate\Database\Seeder;
use App\BlogPosts;
use App\User;
use App\Tag;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $blogPostsCount = (int) $this->command->ask('Berapa jumlah blog post yang ingin anda input ? ', 50);

        $all_users = User::all();
        $tag = Tag::all();

        factory(BlogPosts::class, $blogPostsCount)->make()->each(function ($post) use ($all_users, $tag) {
            /* 
                ? Generate Random Data
            */
            $post->user_id = $all_users->random()->id;
            $post->save();

            $random_tag_counter = rand(1, 6);

            for ($i = 0; $i < $random_tag_counter; $i++) {
                $post->tags()->syncWithoutDetaching($tag->random());
            }
        });
    }
}
