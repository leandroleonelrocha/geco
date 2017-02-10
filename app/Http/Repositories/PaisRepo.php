<?php

namespace App\Http\Repositories;
use App\Entities\Pais;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PaisRepo extends BaseRepo {

    public function getModel()
    {
        return new Pais();
    }

    public function obtenerLenguaje($pais_id){
        return $this->model->where('id', $pais_id)->first();
    }
}