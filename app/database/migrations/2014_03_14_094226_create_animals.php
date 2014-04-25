<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimals extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('id')->on('species');
            $table->string('breed');
            $table->string('size');
            $table->string('weight');
            $table->integer('sex_id')->unsigned();
            $table->foreign('sex_id')->references('id')->on('sexes');
            $table->boolean('neutered')->nullable();
            $table->date('dateofbirth');
            $table->date('dateofarrival');
            $table->date('dateofexit');
            $table->integer('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('coat_id')->unsigned();
            $table->foreign('coat_id')->references('id')->on('coats');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->text('comments');
            $table->string('youtube');
            $table->string('provenance');
            $table->string('deliverer');
            $table->string('chipcode');
            $table->text('vaccinations');
            $table->text('diseases');
            $table->text('surgeries');
            $table->text('treatment');
            $table->text('privatecomments');
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
        Schema::drop('animals');
    }

}
