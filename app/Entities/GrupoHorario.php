<?php
namespace App\Entities;

class GrupoHorario extends Entity {

    protected  $table= 'grupo_horario';
	
    protected $fillable   = ['grupo_id', 'dia', 'horario_desde', 'horario_hasta'];

    public function Grupo()
    {
    	return $this->belongsTo(Grupo::getClass());
    }

    
}