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

filial_id   int not null,
telefono    varchar(50) not null,
created_at  timestamp not null default '0000-00-00 00:00:00',
updated_at  timestamp not null default '0000-00-00 00:00:00',
primary key (filial_id, telefono),
foreign key (filial_id)             references filial (id)