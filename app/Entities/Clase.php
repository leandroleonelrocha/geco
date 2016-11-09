<?php
namespace App\Entities;

class Clase extends Entity {

    protected  $table= 'clase';
   // protected $primaryKey= 'id_curso';

    protected $fillable   = ['id', 'grupo_id','fecha', 'descripcion','docente_id', 'horario_desde', 'horario_hasta'];

    public function Matricula()
    {
    	return $this->belongsToMany(Matricula::getClass())->withPivot('asistio');

    }

    public function Grupo()
    {
 		return $this->belongsTo(Grupo::getClass());
    }

    public function Docente()
    {
    	 return $this->belongsTo(Docente::getClass());
    }
	
}