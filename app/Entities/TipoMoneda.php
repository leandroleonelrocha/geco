<?php

namespace App\Entities;

class TipoMoneda extends Entity
{
    protected $table = 'tipo_moneda';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'simbolo','abreviacion'];

    // Relaciones
    public function Pais(){
        return $this->hasMany(Pais::getClass());
    }

    public function Pago(){
        return $this->hasMany(Pago::getClass());
    }

}