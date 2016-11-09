<?php

namespace App\Entities;

class PersonaTelefono extends Entity
{
    protected $table = 'persona_telefono';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['persona_id','telefono'];

    // Relaciones
    public function Persona(){
        return $this->belongsTo(Persona::getClass());
    }
}
