<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('subject');
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('open');
            $table->timestamps();
            // Staffer - Relationship
            // Category - Relationship
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }

}
