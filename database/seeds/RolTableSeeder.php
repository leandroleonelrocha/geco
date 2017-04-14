<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		 DB::table('rol')->delete();
         //insert some dummy records
         DB::table('rol')->insert(array(
             array('id'=>'2','rol'=>'dueno'),
             array('id'=>'3','rol'=>'director'),
             array('id'=>'4','rol'=>'filial'),
          ));

    }
}
