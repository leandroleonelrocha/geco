<?php
namespace App\Entities;

class Carrera extends Entity {

    protected  $table= 'carrera';
   // protected $primaryKey= 'id_carrera';

    protected $fillable   = ['cadena_id', 'nombre','duracion', 'descripcion', 'lenguaje'];

    public function PersonaInteres(){
        return $this->belongsTo(PersonaInteres::getClass());
    }

    public function Matricula(){
        return $this->hasMany(Matricula::getClass());
    }

    public function Materia(){
        return $this->hasMany(Materia::getClass());
    }

    public function MateriaCarreraCurso(){
        return $this->hasMany(MateriaCarreraCurso::getClass());
    }

    public function getFullNameAttribute()
    {
    	return $this->nombre .', '. $this->descripcion;
    }

}