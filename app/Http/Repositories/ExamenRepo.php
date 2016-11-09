<?php

namespace App\Http\Repositories;
use App\Entities\Examen;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ExamenRepo extends BaseRepo {

    public function getModel()
    {
        return new Examen();
    }

    public function allExamenFilial(){
        $filial = session('usuario')['entidad_id'];
    
        return $this->model->where('activo',1)->where('filial_id', $filial)->get();

    }
}