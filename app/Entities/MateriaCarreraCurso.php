<?php
namespace App\Entities;

class MateriaCarreraCurso extends Entity {

    protected  $table= 'materia_carrera_curso';

    protected $fillable   = ['materia_id','carrera_id','curso_id','ano','optativo'];

    public function Materia(){
        return $this->belongsTo(Materia::getClass());
    }
    
    public function Carrera(){
        return $this->belongsTo(Carrera::getClass());
    }

    public function Curso(){
        return $this->belongsTo(Curso::getClass());
    }
}