<?php

namespace App\Http\Repositories;
use App\Entities\Recibo;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ReciboRepo extends BaseRepo {

    public function getModel()
    {
        return new Recibo();
    }

    public function allReciboPago($pago){
        $filial = session('usuario')['entidad_id'];
        return Recibo::where('pago_id', $pago)->where('filial_id', $filial)->get();
    }
}