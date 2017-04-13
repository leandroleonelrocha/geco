<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculaPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricula_permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('confirmar');

            $table->integer('matricula_id')->unsigned();
            $table->foreign('matricula_id')->references('id')->on('matricula');

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
        Schema::drop('matricula_permisos');
    }
}

