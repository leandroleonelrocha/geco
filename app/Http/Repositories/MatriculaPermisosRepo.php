<?php

namespace App\Http\Repositories;
use App\Entities\MatriculaPermisos;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class MatriculaPermisosRepo extends BaseRepo {

    public function getModel()
    {
        return new MatriculaPermisos();
    }

    public function allFilial(){
    	return $this->model->where('filial_id', $this->filial)->get();
    }
}