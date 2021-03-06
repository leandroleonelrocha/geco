<?php

namespace App\Entities;

class Persona extends Entity
{
    protected $table = 'persona';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_documento_id','nro_documento', 'pais_id','apellidos','nombres','genero','fecha_nacimiento','domicilio','localidad','estado_civil','nivel_estudios','estudio_computacion','posee_computadora','disponibilidad_manana','disponibilidad_tarde','disponibilidad_noche','disponibilidad_sabados','aclaraciones','filial_id','activo'];


    public function findPersona($tipo_documento, $nro_documento){
        
    }

    // Relaciones
    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::getClass());
    }

    public function Pais(){
        return $this->belongsTo(Pais::getClass());
    }

    public function Asesor(){
        return $this->belongsTo(Asesor::getClass());
    }

    public function Preinforme(){
        return $this->hasMany(Preinforme::getClass());
    }

    public function PersonaMail(){
        return $this->hasMany(PersonaMail::getClass());
    }

    public function PersonaTelefono(){
        return $this->hasMany(PersonaTelefono::getClass());
    }

    public function PersonaInteres(){
        return $this->hasMany(PersonaInteres::getClass());
    }

    public function Matricula(){
        return $this->hasMany(Matricula::getClass());
    }

    public function getFullNameAttribute()
    {
        return $this->apellidos .',' . $this->nombres;
    }

    public function Mailing(){
        return $this->belongsTo(Mailing::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }

}
