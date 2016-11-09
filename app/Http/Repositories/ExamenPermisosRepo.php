<?php

namespace App\Http\Repositories;
use App\Entities\ExamenPermisos;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ExamenPermisosRepo extends BaseRepo {

    public function getModel()
    {
        return new ExamenPermisos();
    }

    public function allEneable(){
        $filial = session('usuario')['entidad_id'];
        return $this->model->where('filial_id', $filial)->get();

    }
}