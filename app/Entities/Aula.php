<?php

namespace App\Entities;

class Aula extends Entity
{
    protected $table = 'aula';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','filial_id'];


    // Relaciones
    public function GrupoHorario(){
    	return $this->hasMany(GrupoHorario::getClass());
    }

}
