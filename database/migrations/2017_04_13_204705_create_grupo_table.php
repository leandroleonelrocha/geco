<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('practica');
            $table->boolean('teorica');
            $table->string('descripcion');
            $table->boolean('nuevo');
            $table->boolean('turno_manana');
            $table->boolean('turno_tarde');
            $table->boolean('turno_noche');
            $table->boolean('sabados');
            $table->string('color');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activo');
            $table->boolean('terminado');
            $table->boolean('cancelado');

            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso');
            
            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carrera');
            
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docente');

            $table->integer('filial_id')->unsigned();
            $table->foreign('filial_id')->references('id')->on('filial');


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
        Schema::drop('grupo');
    }
}
