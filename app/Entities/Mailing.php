<?php

namespace App\Entities;

class Mailing extends Entity
{
    protected $table = 'mailing';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['persona_id','filial_id','pago_id', 'moroso','enviado', 'vencimiento_pago','fecha_envio'];

    // Relaciones
    public function Persona(){
        return $this->hasMany(Persona::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }
}
