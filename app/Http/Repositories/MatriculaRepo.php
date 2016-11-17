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
        return $this->model->where('activo', 1)->where('filial_id', $this->filial)->get();
    }

    public function disable($matricula){
        $matricula->activo = 0;
        return $matricula->save();
    }
}