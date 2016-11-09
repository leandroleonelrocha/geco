<?php
namespace App\Entities;

class Curso extends Entity {

    protected  $table= 'curso';
   // protected $primaryKey= 'id_curso';

    protected $fillable   = ['id', 'nombre','duracion', 'descripcion','taller'];

	public function PersonaInteres(){
        return $this->belongsTo(PersonaInteres::getClass());
    }

    public function Matricula(){
        return $this->hasMany(Matricula::getClass());
    }
}