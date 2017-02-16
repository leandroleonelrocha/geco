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
    protected $fillable = ['persona_id','asesor_id','descripcion','medio_id','como_encontro_id','filial_id'];

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

    public function PreinformeMedio(){
        return $this->belongsTo(PreinformeMedio::getClass(), 'medio_id');
    }

    public function PreinformeComoEncontro(){
        return $this->belongsTo(PreinformeComoEncontro::getClass(),'como_encontro_id');
    }
}
