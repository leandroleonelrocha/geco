<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaInteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_interes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');

            $table->integer('preinforme_id')->unsigned();
            $table->foreign('preinforme_id')->references('id')->on('preinforme');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');
            
            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carrera');
            
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso');
            

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
        Schema::drop('persona_interes');
    }
}

