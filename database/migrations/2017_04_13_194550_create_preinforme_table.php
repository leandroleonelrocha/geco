<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreinformeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preinforme', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');

            $table->integer('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('asesor');

            $table->integer('como_encontro_id')->unsigned();
            $table->foreign('como_encontro_id')->references('id')->on('preinforme_como_encontro');

            $table->integer('medio_id')->unsigned();
            $table->foreign('medio_id')->references('id')->on('preinforme_medio');

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
        Schema::drop('preinforme');
    }
}

