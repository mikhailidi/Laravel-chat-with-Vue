<?php

namespace Modules\Friend\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Friend\Models\FriendRequest;
use Modules\User\Models\User;

class FriendRequestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $users = User::all()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $from_user = $faker->randomElement($users);
            $to_user = $faker->randomElement($users);

            while ($from_user == $to_user) {
                $to_user = $faker->randomElement($users);
            }

            FriendRequest::create([
               'from_user' => $from_user,
               'to_user' => $to_user
            ]);
        }
    }
}
