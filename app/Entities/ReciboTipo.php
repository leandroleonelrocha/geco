<?php

namespace App\Entities;

class ReciboTipo extends Entity
{
    protected $table = 'recibo_tipo';

    protected $fillable = ['recibo_tipo'];

    // Relaciones
    public function Recibo(){
        return $this->hasMany(Recibo::getClass());
    }
}
