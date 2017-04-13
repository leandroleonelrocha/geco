<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsesorMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor_mail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail');
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
        Schema::drop('asesor_mail');
    }
}
