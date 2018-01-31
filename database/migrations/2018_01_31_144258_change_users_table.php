<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('username', 60)->after('id')->unique();
            $table->string('first_name', 20)->after('id');
            $table->string('last_name', 36)->after('first_name');
            $table->text('avatar')->after('remember_token')->nullable();
            $table->boolean('confirmed')->after('avatar')->default(0);
            $table->softDeletes();
        });
    }
}
