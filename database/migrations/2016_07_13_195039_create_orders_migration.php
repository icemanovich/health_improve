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

            // from user
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // to doctor
            $table->integer('target_id')->unsigned()->index();
            $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');

            /*
             * working hour for doctor (data + hour time)
             *
             *
             * WARNING!
             * Default value is 'Y-m-d H:00:00' but date function returns date not in needed timezone!
             * Thats why need to manually set date from script
             * */
            $table->dateTime('date');

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
