<?php

namespace Modules\Friend\Database\Factories;

use Faker\Generator as Faker;
use Modules\Friend\Models\Friend;
use Modules\User\Models\User;

$factory->define(Friend::class, function () {
    return [
        'user_id' => '1',
        'friend_id' => '2',
    ];
});
