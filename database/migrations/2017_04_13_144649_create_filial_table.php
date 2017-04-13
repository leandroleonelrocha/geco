<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filial', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('localidad');
            $table->integer('codigo_postal');
            $table->string('mail');
            $table->boolean('activo')

            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadena');

            $table->integer('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')->on('pais');

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
        Schema::drop('filial');
    }
}

