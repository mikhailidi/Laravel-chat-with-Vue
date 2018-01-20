<?php

use Faker\Generator as Faker;

$factory->define(App\Friend::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 40),
        'friend_id' => $faker->numberBetween(1, 40),
    ];
});
