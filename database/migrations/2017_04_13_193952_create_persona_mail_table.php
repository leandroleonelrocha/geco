<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_mail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');
            
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
        Schema::drop('persona_mail');
    }
}
