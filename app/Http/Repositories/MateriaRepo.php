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

	public function deleteMateria($id){
        return Materia::where('id', '=', $id)->delete();
    }

   
}