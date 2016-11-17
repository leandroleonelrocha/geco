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

        return $this->model->where('filial_id', $this->filial)->get();
    }

    public function allMatricula($id){
        return $this->model->where('matricula_id', $id)->get();
    }
}