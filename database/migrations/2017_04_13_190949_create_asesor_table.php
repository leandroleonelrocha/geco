<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_documento');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('direccion');
            $table->string('localidad');
            $table->boolean('activo');

            $table->integer('filial_id')->unsigned();
            $table->foreign('filial_id')->references('id')->on('filial');

            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');

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
        Schema::drop('asesor');
    }
}

