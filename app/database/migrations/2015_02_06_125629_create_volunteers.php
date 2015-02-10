<?php

// See http://laravel.com/docs/migrations
//     http://laravel.com/docs/schema

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function(Blueprint $table)
        {
            $table->integer('id')->unsigned()->unique();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->string('alias');
            $table->string('task');
            $table->text('description');
            $table->string('photo');
            $table->boolean('publish');
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
        Schema::drop('volunteers');
    }

}
