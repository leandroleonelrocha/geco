<?php

namespace App\Http\Repositories;
use App\Entities\ReciboTipo;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ReciboTipoRepo extends BaseRepo {

    public function getModel()
    {
        return new ReciboTipo();
    }
}