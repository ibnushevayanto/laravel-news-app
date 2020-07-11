<?php

use Illuminate\Database\Seeder;
use App\BlogPosts;
use App\User;

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

        factory(BlogPosts::class, $blogPostsCount)->make()->each(function ($post) use ($all_users) {
            /* 
                ? Generate Random Data
            */
            $post->user_id = $all_users->random()->id;
            $post->save();
        });
    }
}
