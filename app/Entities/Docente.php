<?php

namespace App\Entities;

class Docente extends Entity
{
    protected $table = 'docente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_documento_id','nro_documento','apellidos','nombres','descripcion','disponibilidad_manana','disponibilidad_tarde','disponibilidad_noche','disponibilidad_sabados','filial_id','activo'];

    // Relaciones
    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::getClass());
    }

    public function getFullNameAttribute()
    {
        return $this->apellidos .','. $this->nombres;
    }

}
