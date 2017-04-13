<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaCarreraCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('materia_carrera_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ano');
            $table->boolean('optativo');


            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materia'); 
            
            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carrera'); 
            
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso'); 
            
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
        Schema::drop('materia_carrera_curso');
    }
}
