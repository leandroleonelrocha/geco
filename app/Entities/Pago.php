<?php

namespace App\Entities;

class Pago extends Entity
{
    protected $table = 'pago';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['matricula_id', 'tipo_moneda_id','nro_pago','pago_individual','descripcion','terminado','vencimiento','monto_original','monto_actual', 'monto_pago','descuento', 'recargo', 'filial_id'];

    // Relaciones
    public function Matricula(){
        return $this->belongsTo(Matricula::getClass());
    }

    public function Recibos(){
        return $this->hasMany(Recibo::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }

    public function TipoMoneda(){
        return $this->belongsTo(TipoMoneda::getClass());
    }
}
