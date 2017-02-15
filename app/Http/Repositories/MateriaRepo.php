<?php

namespace App\Http\Repositories;
use App\Entities\Materia;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class MateriaRepo extends BaseRepo {

    public function getModel()
    {
        return new Materia();
    }

	public function deleteMateria($id){
        return Materia::where('id', '=', $id)->delete();
    }

    public function allMaterias($cad){
        return $this->model->where('cadena_id', $cad)->paginate(10);
    }

    public function allMateriasLista($data, $id,$cad){
        return $this->model->where('cadena_id', $cad)->lists($data, $id);
    }
}