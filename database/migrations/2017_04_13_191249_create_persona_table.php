<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_documento');
            $table->string('apellidos');
            $table->string('nombres');
            $table->char('genero');
            $table->date('fecha_nacimiento');
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('estado_civil');
            $table->string('nivel_estudios');
            $table->boolean('estudio_computacion');
            $table->boolean('posee_computadora');
            $table->boolean('disponibilidad_manana');
            $table->boolean('disponibilidad_tarde');
            $table->boolean('disponibilidad_noche');
            $table->boolean('disponibilidad_sabados');
            $table->string('aclaraciones');
            $table->boolean('activo');

            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            
            /*
            $table->integer('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('asesor');
            */

            $table->integer('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')->on('pais');

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
        Schema::drop('persona');
    }
}
