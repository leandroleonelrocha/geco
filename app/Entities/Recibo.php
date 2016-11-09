<?php

namespace App\Entities;

class Recibo extends Entity
{
    protected $table = 'recibo';

    protected $fillable = ['recibo_tipo_id','pago_id','monto','recibo_concepto_pago_id','descripcion','filial_id'];

    // Relaciones
    public function Pago(){
        return $this->belongsTo(Pago::getClass());
    }

    public function ReciboTipo(){
        return $this->belongsTo(ReciboTipo::getClass());
    }

    public function ReciboConceptoPago(){
        return $this->belongsTo(ReciboConceptoPago::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }
}
