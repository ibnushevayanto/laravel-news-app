<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('migrate:fresh');
        $this->command->info('Berhasil merefresh database');

        Cache::tags(['blog-post'])->flush();

        /* 
            ? Setelah membuat database seeder, sebelum menggenerate jalankan terlebih dahulu 
            ! composer dump-autoload
        */
        $this->call([UsersTableSeeder::class, TagsTableSeeder::class, BlogPostsTableSeeder::class, CommentsTableSeeder::class]);
    }
}
