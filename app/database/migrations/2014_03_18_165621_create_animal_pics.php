<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalPics extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_pics', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('filename');
            $table->integer('animal_id')->unsigned();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('animal_pics');
    }

}
