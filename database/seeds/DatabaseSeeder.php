<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('migrate:refresh');
        $this->command->info('Berhasil merefresh database');
        /* 
            ? Setelah membuat database seeder, sebelum menggenerate jalankan terlebih dahulu 
            ! composer dump-autoload
        */
        $this->call([UsersTableSeeder::class, BlogPostsTableSeeder::class, CommentsTableSeeder::class]);
    }
}
