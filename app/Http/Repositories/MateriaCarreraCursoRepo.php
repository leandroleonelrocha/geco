<?php

namespace App\Http\Repositories;
use App\Entities\MateriaCarreraCurso;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class MateriaCarreraCursoRepo extends BaseRepo {

    public function getModel()
    {
        return new MateriaCarreraCurso();
    }

    public function findMateriaCarreraCurso($materia_id){

    	return $this->model->where('materia_id',$materia_id)->get();
    }
}