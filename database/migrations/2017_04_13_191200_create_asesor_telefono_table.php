<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsesorTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor_telefono', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefono');
            $table->integer('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('asesor');
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
        Schema::drop('asesor_telefono');
    }
}

