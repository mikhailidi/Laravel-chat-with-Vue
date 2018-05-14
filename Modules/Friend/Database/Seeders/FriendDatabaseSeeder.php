<?php

namespace Modules\Friend\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Friend\Models\Friend;
use Modules\Friend\Models\FriendRequest;
use Modules\User\Models\User;

class FriendDatabaseSeeder extends Seeder
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
            $user_id = $faker->randomElement($users);
            $friend_id = $faker->randomElement($users);

            while ($user_id == $friend_id) {
                $friend_id = $faker->randomElement($users);
            }

            $friendRequest = FriendRequest::where([
                ['from_user', $user_id],
                ['to_user', $friend_id]
            ])->orWhere([
                ['from_user', $friend_id],
                ['to_user', $user_id]
            ])->first();

            if (!$friendRequest) {
                \factory(Friend::class)->create([
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                ]);

                \factory(Friend::class)->create([
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                ]);
            }
        }
    }
}
