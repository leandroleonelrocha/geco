<?php

namespace App\Http\Repositories;
use App\Entities\Examen;
use App\Entities\Grupo;
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
        //traerme todos los id del grupo de la misma filial
        $grupo_id=[];
        $grupo = Grupo::where('filial_id', 3)->get();
        foreach ($grupo as $g)
        {
            array_push($grupo_id, $g->id);
        }

    	$examenes = Examen::whereIn('grupo_id', $grupo_id)->get();
		$resultado = [];

		foreach ($examenes as  $key => $value) {

            $suma = 0 + $value->nota;
            $data['cantidadexamenes'] = $examenes->count();
            $data['sumatota']=$suma;
            $data['resultado']=4;

		}
        dd($data);

		return $resultado;
    }

    public function allRecuperatorio($id){
         return $this->model->where('recuperatorio_nro_acta',$id)->get();
     }
}