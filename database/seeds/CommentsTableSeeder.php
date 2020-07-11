<?php

use App\BlogPosts;
use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPosts::all();
        if ($posts->count() === 0) {
            $this->command->info('Tidak ada blog post yang tersedia jadi anda tidak perlu menginput komentar');
            return;
        }
        $commentsCount = (int) $this->command->ask('Berapa jumlah komentar yang ingin anda input ? ', 100);
        factory(Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
