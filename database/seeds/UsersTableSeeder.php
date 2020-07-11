<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = (int) $this->command->ask('Berapa jumlah user yang ingin anda input ?', 20);
        factory(User::class)->states('my-account')->create();
        factory(User::class, $usersCount)->create();
    }
}
