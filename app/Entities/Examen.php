<?php

namespace App\Entities;

class Examen extends Entity
{
    protected $table = 'examen';
    protected $primaryKey = 'nro_acta';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nro_acta','recuperatorio_nro_acta', 'matricula_id', 'grupo_id', 'nota', 'carrera_id', 'materia_id', 'docente_id'];

    // Relaciones
    
   
    public function Matricula(){
        return $this->belongsTo(Matricula::getClass());
    }

    public function Grupo(){
        return $this->belongsTo(Grupo::getClass());
    }
    public function Docente(){
        return $this->belongsTo(Docente::getClass());
    }
     public function Carrera(){
        return $this->belongsTo(Carrera::getClass());
    }
     public function Materia(){
        return $this->belongsTo(Materia::getClass());
    }
}

