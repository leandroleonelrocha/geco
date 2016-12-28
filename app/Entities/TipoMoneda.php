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
    protected $fillable = ['pais_id','nombre', 'simbolo','abreviacion'];

    // Relaciones
    public function Pais(){
        return $this->belongsTo(Pais::getClass());
    }

}