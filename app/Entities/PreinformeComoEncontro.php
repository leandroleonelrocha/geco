<?php

namespace App\Entities;

class PreinformeComoEncontro extends Entity
{
    protected $table = 'preinforme_como_encontro';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['como_encontro','lenguaje'];


    // Relaciones
    public function Preinforme(){
    	return $this->hasMany(Preinforme::getClass());
    }

}