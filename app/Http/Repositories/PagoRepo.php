<?php

namespace App\Http\Repositories;
use App\Entities\Pago;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PagoRepo extends BaseRepo {

    public function getModel()
    {
        return new Pago();
    }

    public function allFilial(){
        $filial = session('usuario')['entidad_id'];
        return Pago::where('filial_id', $filial)->get();
    }

    public function allMatricula($id){
        return Pago::where('matricula_id', $id)->get();
    }
}