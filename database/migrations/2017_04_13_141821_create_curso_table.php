<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoTable extends Migration
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
            $table->string('duracion');
            $table->string('descripcion');
            $table->boolean('taller');
            $table->char('lenguaje');
            
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
