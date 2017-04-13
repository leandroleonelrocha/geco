<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('descripcion');
            $table->string('nro_documento');
            $table->boolean('disponibilidad_manana');
            $table->boolean('disponibilidad_tarde');
            $table->boolean('disponibilidad_noche');
            $table->boolean('disponibilidad_sabados');
            $table->boolean('activo');

            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');

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
        Schema::drop('docente');
    }
}

