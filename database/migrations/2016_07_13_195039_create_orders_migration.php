<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            // make as relations
//            $table->string('user_id');      // from user
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

//            $table->string('target_id');    // to doctor
            $table->integer('target_id')->unsigned()->index();
            $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');


            $table->string('description');
            $table->dateTime('work');       // working hours for doctor

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
        Schema::drop('orders');
    }
}
