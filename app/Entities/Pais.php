<?php

namespace App\Entities;

class Pais extends Entity
{
    protected $table = 'pais';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pais','lenguaje', 'tipo_moneda_id'];

    // Relaciones
    public function Filial(){
        return $this->hasMany(Filial::getClass());
    }

    public function Persona(){
        return $this->hasMany(Persona::getClass());
    }

    public function TipoMoneda(){
        return $this->belongsTo(TipoMoneda::getClass());
    }
}