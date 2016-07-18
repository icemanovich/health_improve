<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();      // used for login
            $table->string('password', 60);

            $table->string('phone')->nullable();
            $table->string('type')->default(\App\User::TYPE_USER);
            $table->string('description')->nullable();
            $table->string('workplace')->nullable();
            $table->string('speciality')->nullable();   // should be relation to table, but this is only demo )

            $table->string('photo')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('rating')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
