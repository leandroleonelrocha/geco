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
        return $this->model->where('activo',1)->where('filial_id', $this->filial)->get();

    }

    public function allExamenFilialMatricula(){
    	$filial = session('usuario')['entidad_id'];
    	$examen = $this->model->all();
		$resultado = [];
		foreach ($examen as  $value) {
			if($value->Matricula->Filial->id == $filial)
			{
                dd($value->get()->groupBy('grupo_id'));
				array_push($resultado, $value);
			}	
		}

		return $resultado;
    }
   
}