<?php

namespace App\Http\Repositories;
use App\Entities\Matricula;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class MatriculaRepo extends BaseRepo {

    public function getModel()
    {
        return new Matricula();
    }
    
    public function allEneable(){
        $filial = session('usuario')['entidad_id'];
        return $this->model->where('activo', 1)->where('filial_id', $filial)->get();
    }

    public function disable($matricula){
        $matricula->activo = 0;
        return $matricula->save();
    }
}