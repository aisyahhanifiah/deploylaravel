<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('venue');
            $table->integer('level_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('domain_id')->unsigned();
            $table->integer('club_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('domain_id')->references('id')->on('domains');
            $table->string('requirement');
            $table->integer('capacity');
            $table->double('fees', 4, 2);
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->timestamps();
            // $table->string('stripe_connect_id')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
