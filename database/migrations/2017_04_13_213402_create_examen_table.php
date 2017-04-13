<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_acta');
            $table->integer('recuperatorio_nro_acta');
            $table->integer('nota');

            $table->integer('matricula_id')->unsigned();
            $table->foreign('matricula_id')->references('id')->on('matricula');
            
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupo');
            
            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carrera');
            
            $table->integer('materia')->unsigned();
            $table->foreign('materia')->references('id')->on('materia');
            
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docente');
            


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
        Schema::drop('examen');
    }
}

