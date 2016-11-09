<?php

namespace App\Entities;

class AsesorMail extends Entity
{
    protected $table = 'asesor_mail';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asesor_id','mail'];

    // Relaciones
    public function Asesor(){
        return $this->belongsTo(Asesor::getClass());
    }

}