<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreinformeComoEncontroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preinforme_como_encontro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('como_encontro');
            $table->char('lenguaje');
            
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
        Schema::drop('preinforme_como_encontro');
    }
}
