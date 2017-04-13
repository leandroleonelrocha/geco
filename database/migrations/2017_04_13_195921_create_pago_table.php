<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_pago');
            $table->boolean('pago_individual');
            $table->string('descripcion');
            $table->boolean('terminado');
            $table->date('vencimiento');
            $table->date('fecha_recargo');
            $table->float('monto_original');
            $table->float('monto_actual');
            $table->float('monto_pago');
            $table->float('descuento');
            $table->float('recargo');
            $table->float('descuento_adicional');
            $table->float('recargo_adicional');

            $table->integer('matricula_id')->unsigned();
            $table->foreign('matricula_id')->references('id')->on('matricula');

            $table->integer('tipo_moneda_id')->unsigned();
            $table->foreign('tipo_moneda_id')->references('id')->on('tipo_moneda');
           
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
        Schema::drop('pago');
    }
}
