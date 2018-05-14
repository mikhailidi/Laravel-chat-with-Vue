<?php

namespace Modules\User\Database\Seeders;

use Faker\Factory;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \factory(User::class, 40)->create();
    }
}
