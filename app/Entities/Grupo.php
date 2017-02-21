<?php
namespace App\Entities;

class Grupo extends Entity {

    protected  $table= 'grupo';

   protected $fillable   = ['curso_id', 'carrera_id', 'practica', 'teorica', 'descripcion', 'docente_id', 'nuevo', 'turno_manana', 'turno_tarde', 'turno_noche', 'sabados', 'color', 'fecha_inicio', 'fecha_fin' , 'filial_id', 'activo', 'terminado', 'cancelado'];
    

    //Relaciones
    public function Matricula(){
        return $this->belongsToMany(Matricula::getClass());
    }

	public function PersonaInteres(){
        return $this->belongsTo(PersonaInteres::getClass());
    }

	public function Curso(){
        return $this->belongsTo(Curso::getClass());
    }

	public function Carrera(){
        return $this->belongsTo(Carrera::getClass());
    }

	public function Materia(){
        return $this->belongsTo(Materia::getClass());
    }

 	public function Docente(){
        return $this->belongsTo(Docente::getClass());
    }
    
    public function Clase(){
        return $this->belongsToMany(CLase::getClass());
    }

    public function Clases(){
        return $this->hasMany(CLase::getClass());   
    }  

    public function GrupoMatricula(){
        return $this->belongsTo(GrupoMatricula::getClass());
    }

    public function Mailing(){
        return $this->belongsTo(Mailing::getClass());
    }

    public function getFullDateAttribute()
    {
        //10/26/2016 - 10/26/2016

        $inicio = date("m/d/Y", strtotime($this->fecha_inicio));
        $fin =date("m/d/Y", strtotime($this->fecha_fin));
        
        return $inicio .' - '. $fin;
    }

    public function getFullNameAttribute()
    {

        return $this->id .' ('.$this->descripcion.')';
    }

    public function GrupoHorario(){
        return $this->hasMany(GrupoHorario::getClass());
    }
}