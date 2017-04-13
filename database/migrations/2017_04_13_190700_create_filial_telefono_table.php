<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilialTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filial_telefono', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefono');
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
        Schema::drop('filial_telefono');
    }
}
