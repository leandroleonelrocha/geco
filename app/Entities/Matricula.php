<?php

namespace App\Entities;

class Matricula extends Entity
{
    protected $table = 'matricula';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['persona_id','curso_id','carrera_id','filial_id','asesor_id','activo','terminado','cancelado'];

    // Relaciones
    public function Persona(){
        return $this->belongsTo(Persona::getClass());
    }

    public function Asesor(){
        return $this->belongsTo(Asesor::getClass());
    }

    public function Pago(){
        return $this->belongsTo(Pago::getClass());
    }

    public function Grupo(){
        return $this->belongsToMany(Grupo::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }

    public function Curso(){
        return $this->belongsTo(Curso::getClass());
    }

    public function Carrera(){
        return $this->belongsTo(Carrera::getClass());
    }

    public function MatriculaPermisos(){
        return $this->belongsTo(MatriculaPermisos::getClass());
    }

    public function Clase(){ 
        return $this->belongsToMany(Clase::getClass())->withPivot('asistio');
    
    }

    public function Examen(){ 
        return $this->hasMany(Clase::getClass())->withPivot('asistio');
    
    }

    public function getFullNameAttribute()
    {
        return $this->persona_id;
    }

}
