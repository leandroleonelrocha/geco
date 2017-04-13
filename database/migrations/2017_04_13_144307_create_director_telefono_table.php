<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director_telefono', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefono');

            $table->integer('director_id')->unsigned();
            $table->foreign('director_id')->references('id')->on('director');

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
        Schema::drop('director_telefono');
    }
}
