<?php
namespace App\Entities;

class Curso extends Entity {

    protected  $table= 'curso';
   // protected $primaryKey= 'id_curso';

    protected $fillable   = ['cadena_id', 'nombre','duracion', 'descripcion','taller', 'lenguaje'];

	public function PersonaInteres(){
        return $this->hasMany(PersonaInteres::getClass());
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
}