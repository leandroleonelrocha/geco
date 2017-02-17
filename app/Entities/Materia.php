<?php
namespace App\Entities;

class Materia extends Entity {

    protected  $table= 'materia';
  //  protected $primaryKey= 'id_materia';


    protected $fillable   = ['carrera_id','cadena_id','nombre','practica', 'teorica','descripcion'];

    public function Carrera(){
        return $this->belongsTo(Carrera::getClass());
    }

    public function GrupoHorario(){
    	return $this->hasMany(GrupoHorario::getClass());
    }
}