<?php

use App\BlogPosts;
use App\Comment;
use App\User;
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
        $users = User::all();
        if ($posts->count() === 0) {
            $this->command->info('Tidak ada blog post yang tersedia jadi anda tidak perlu menginput komentar');
            return;
        }

        if ($users->count() === 0) {
            $this->command->info('Tidak ada user yang tersedia jadi anda tidak perlu menginput komentar');
            return;
        }

        $commentsCount = (int) $this->command->ask('Berapa jumlah komentar yang ingin anda input ? ', 100);

        factory(Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $users) {
            $posts->random()->comments()->create(['user_id' => $users->random()->id, 'content' => $comment->content]);
        });

        factory(Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $users) {
            if ($users->random()->id != $posts->random()->id) {
                $users->random()->comments()->create(['user_id' => $users->random()->id, 'content' => $comment->content]);
            }
        });
    }
}
