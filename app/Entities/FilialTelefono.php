<?php

namespace App\Entities;

class FilialTelefono extends Entity
{
    protected $table = 'filial_telefono';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['filial_id','telefono'];

    // Relaciones
    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }
}