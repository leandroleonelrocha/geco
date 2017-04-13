<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricula', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('activo');
            $table->boolean('terminado');
            $table->boolean('cancelado');
            $table->date('ultimo_mail_enviado');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');

            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso');

            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carrera');

            $table->integer('filial_id')->unsigned();
            $table->foreign('filial_id')->references('id')->on('filial');

            $table->integer('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('asesor');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matricula');
    }
}
