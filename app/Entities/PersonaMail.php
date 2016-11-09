<?php

namespace App\Entities;

class PersonaMail extends Entity
{
    protected $table = 'persona_mail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['persona_id','mail'];

    // Relaciones
    public function Persona(){
        return $this->belongsTo(Persona::getClass());
    }
}
