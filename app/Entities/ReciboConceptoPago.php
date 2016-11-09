<?php

namespace App\Entities;

class ReciboConceptoPago extends Entity
{
    protected $table = 'recibo_concepto_pago';

    protected $fillable = ['concepto_pago'];

    // Relaciones
    public function Recibo(){
        return $this->hasMany(Recibo::getClass());
    }
}
