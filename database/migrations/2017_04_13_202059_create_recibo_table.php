<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo', function (Blueprint $table) {
            $table->increments('id');
            $table->float('monto');
            $table->datetime('fecha');
            $table->string('descripcion');

            $table->integer('recibo_tipo_id')->unsigned();
            $table->foreign('recibo_tipo_id')->references('id')->on('recibo_tipo');

            $table->integer('tipo_moneda_id')->unsigned();
            $table->foreign('tipo_moneda_id')->references('id')->on('tipo_moneda');

            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pago');

            $table->integer('filial_id')->unsigned();
            $table->foreign('filial_id')->references('id')->on('filial');

            $table->integer('recibo_concepto_pago_id')->unsigned();
            $table->foreign('recibo_concepto_pago_id')->references('id')->on('recibo_concepto_pago');

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
        Schema::drop('recibo');
    }
}

