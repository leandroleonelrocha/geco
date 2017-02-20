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

    public function findMateriasCarrera($carrera_id, $tp){
    	if ($tp == 'practica') {
    		return Materia::where('carrera_id', '=', $carrera_id)
    						->where('practica', '=', 1)
    						->get();
    	}
    	elseif($tp == 'teorica'){
    		return Materia::where('carrera_id', '=', $carrera_id)
    						->where('teorica', '=', 1)
    						->get();
    	}
    }

    public function findMateriasCurso($curso_id){
        return Materia::where('curso_id', '=', $curso_id)
                        ->where('practica', '=', 1)
                        ->where('teorica', '=', 1)
                        ->get();
    }

	public function deleteMateria($id){
        return Materia::where('id', '=', $id)->delete();
    }

    public function allMaterias($cad){
        return $this->model->where('cadena_id', $cad)->get();
    }

    public function allMateriasLista($data, $id,$cad){
        return $this->model->where('cadena_id', $cad)->lists($data, $id);
    }
}