<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaseMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_matricula', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('asistio');

            $table->integer('clase_id')->unsigned();
            $table->foreign('clase_id')->references('id')->on('clase');
            
            $table->integer('matricula_id')->unsigned();
            $table->foreign('matricula_id')->references('id')->on('matricula');


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
        Schema::drop('clase_matricula');
    }
}
