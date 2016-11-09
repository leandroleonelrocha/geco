<?php

namespace App\Entities;

class TipoDocumento extends Entity
{
    protected $table = 'tipo_documento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_documento'];

    // Relaciones
    public function Docente()
    {
        return $this->hasMany(Docente::getClass());
    }

    public function Persona()
    {
        return $this->hasMany(Persona::getClass());
    }

    public function Asesor()
    {
        return $this->hasMany(Asesor::getClass());
    }
}
