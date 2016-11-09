<?php

namespace App\Entities;

class AsesorTelefono extends Entity
{
    protected $table = 'asesor_telefono';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asesor_id','telefono'];

    // Relaciones
    public function Asesor(){
        return $this->belongsTo(Asesor::getClass());
    }
}