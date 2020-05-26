<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('club_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->integer('pay_method_id')->unsigned()->nullable;
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->integer('transaction_id')->nullable();
            $table->foreign('pay_method_id')->references('id')->on('pay_method');
            $table->timestamps();
            // $table->string('stripe_charge_id')->nullable();
            // $table->double('paid_out', 5, 2)->nullable();
            // $table->double('fees_collected', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_user');
    }
}
