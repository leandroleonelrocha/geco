<?php

namespace App\Http\Repositories;
use App\Entities\Carrera;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class CarreraRepo extends BaseRepo {

    public function getModel()
    {
        return new Carrera();
    }

    public function allCarreras($len,$cad){
        return $this->model->where('lenguaje', $len)->where('cadena_id', $cad)->get();
    }

}