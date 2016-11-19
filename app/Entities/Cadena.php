<?php

namespace App\Entities;

class Cadena extends Entity
{
    protected $table = 'cadena';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','mail','telefono'];

    // Relaciones
    public function Filial(){
        return $this->hasMany(Filial::getClass());
    }

}
