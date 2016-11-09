<?php
namespace App\Entities;

class ClaseMatricula extends Entity {

    protected  $table= 'clase_matricula';
    protected $fillable   = ['asistio','matricula_id','clase_id'];
    protected $attributes = [
       'asistio' => 'false'
    ];
   
    public function Clase()
    {
    	return $this->belongsTo(Clase::getClass());
    }

    public function Matricula()
    {
    	return $this->belongsTo(Matricula::getClass());
    }
    	
}