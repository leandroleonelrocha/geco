<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha');
            $table->integer('dia');
            $table->time('horario_desde');
            $table->time('horario_hasta');
            $table->boolean('enviado');
            $table->string('descripcion');

            $table->integer('clase_estado_id')->unsigned();
            $table->foreign('clase_estado_id')->references('id')->on('clase_estado');

            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupo');
            
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docente');
            
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
        Schema::drop('clase');
    }
}

