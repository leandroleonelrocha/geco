<?php
namespace App\Entities;

class GrupoHorario extends Entity {

    protected  $table= 'grupo_horario';
	
    protected $fillable   = ['grupo_id', 'dia', 'horario_desde', 'horario_hasta', 'materia_id', 'fecha_inicio', 'cantidad_clases', 'aula_id'];

    public function Grupo(){
    	return $this->belongsTo(Grupo::getClass());
    }

    public function Materia(){
    	return $this->belongsTo(Materia::getClass());
    }

    public function Aula(){
    	return $this->belongsTo(Aula::getClass());
    }
}