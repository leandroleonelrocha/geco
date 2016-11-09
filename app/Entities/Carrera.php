<?php
namespace App\Entities;

class Carrera extends Entity {

    protected  $table= 'carrera';
   // protected $primaryKey= 'id_carrera';

    protected $fillable   = ['id', 'nombre','duracion', 'descripcion'];

    public function PersonaInteres(){
        return $this->belongsTo(PersonaInteres::getClass());
    }

    public function Matricula(){
        return $this->hasMany(Matricula::getClass());

    }

    public function getFullNameAttribute()
    {
    	return $this->nombre .', '. $this->descripcion;
    }

}