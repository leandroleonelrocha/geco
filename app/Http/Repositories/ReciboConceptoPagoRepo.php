<?php

namespace App\Http\Repositories;
use App\Entities\ReciboConceptoPago;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ReciboConceptoPagoRepo extends BaseRepo {

    public function getModel()
    {
        return new ReciboConceptoPago();
    }
}