<?php

namespace App\Entities;

class Preinforme extends Entity
{
    protected $table = 'preinforme';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['persona_id','asesor_id','descripcion','medio','como_encontro','filial_id'];

    // Relaciones
    public function Persona(){
        return $this->belongsTo(Persona::getClass());
    }

    public function Asesor(){
        return $this->belongsTo(Asesor::getClass());
    }

    public function PersonaInteres(){
        return $this->belongsTo(PersonaInteres::getClass());
    }
}
