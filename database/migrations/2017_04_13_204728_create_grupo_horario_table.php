<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_horario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_clases');
            $table->time('horario_desde');
            $table->time('horario_hasta');
            $table->date('fecha_inicio');
            $table->enum('dia', ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo']);

            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupo');

            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materia');
            
            $table->integer('aula_id')->unsigned();
            $table->foreign('aula_id')->references('id')->on('aula');
            
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
        Schema::drop('grupo_horario');
    }
}
