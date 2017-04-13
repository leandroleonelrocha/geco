<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('curso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('practica');
            $table->boolean('teorica');
            $table->time('duracion');
            $table->string('descripcion');
            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadena'); 
           
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
        Schema::drop('curso');
    }
}
