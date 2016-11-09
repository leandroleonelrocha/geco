<?php

namespace App\Entities;

class AsesorFilial extends Entity
{
    protected $table = 'asesor_filial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asesor_id','filial_id'];

    // Relaciones

     public function Asesor(){
         return $this->belongsTo(Asesor::getClass());
     }


    public function getFullNameAttribute()
    {
        return  $this->Asesor->apellidos . ', ' . $this->Asesor->nombres ;
    }
}