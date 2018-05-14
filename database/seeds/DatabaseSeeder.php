<?php

use Illuminate\Database\Seeder;
use \Modules\User\Database\Seeders\UserTableSeeder;
use \Modules\Friend\Database\Seeders\FriendRequestDatabaseSeeder;
use \Modules\Friend\Database\Seeders\FriendDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            FriendRequestDatabaseSeeder::class,
            FriendDatabaseSeeder::class
        ]);
    }
}
