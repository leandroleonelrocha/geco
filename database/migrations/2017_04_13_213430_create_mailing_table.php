<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');

            $table->integer('filial_id')->unsigned();
            $table->foreign('filial_id')->references('id')->on('filial');

            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pago');

            $table->boolean('moroso');
            $table->boolean('enviado');
            $table->date('vencimiento_pago');
            $table->datetime('fecha_envio');

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
        Schema::drop('mailing');
    }
}


