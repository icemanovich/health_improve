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
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();

            $table->string('type')->default();
            $table->string('description')->nullable();
            $table->string('workplace')->nullable();
            $table->string('speciality');   // should be relation to table, but this is only demo )

            $table->string('photo')->nullable();
            $table->enum('gender', ['male', 'feemale'])->default('male');
            $table->string('rating')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();
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
