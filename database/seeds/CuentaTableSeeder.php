<?php

use Illuminate\Database\Seeder;

class CuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         DB::table('cuenta')->delete();
         //insert some dummy records
         DB::table('cuenta')->insert(array(
             array(
             	'id'=>'1',
             	'usuario'=>'filial@filial.com',
             	'contrasena'=>'$2y$10$0PsN63XTqAdphh3onJ7dZOcC1JOfPwCTk66jHpPbX5yYNAlmrzt.i',
             	'habilitado'=>'1',
             	'rol_id'=>'4',
             	'entidad_id'=>'1',
             	'activo'=>'1'
             	)
           
          ));

    }
}


