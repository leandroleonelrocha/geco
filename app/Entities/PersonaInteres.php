<?php

namespace App\Entities;

class PersonaInteres extends Entity
{
    protected $table = 'persona_interes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['preinforme_id','persona_id','carrera_id','curso_id','descripcion'];

    // Relaciones
    public function Preinforme(){
        return $this->hasMany(Preinforme::getClass());
    }

    public function Persona(){
        return $this->belongsTo(Persona::getClass());
    }

    public function Carrera(){
        return $this->hasMany(Carrera::getClass());
    }

    public function Curso(){
        return $this->hasMany(Curso::getClass());
    }
}
