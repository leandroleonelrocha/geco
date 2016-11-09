<?php

namespace App\Http\Repositories;
use App\Entities\ClaseMatricula;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ClaseMatriculaRepo extends BaseRepo {

    public function getModel()
    {
        return new ClaseMatricula();
    }

    public function buscarClasePorMatricula($matricula, $clase)
    {
    	$qry = $this->model->where('matricula_id', $matricula)->where('clase_id',$clase)->first();
        if(count($qry) > 0)
        { 
            return $qry->asistio ? 'true' : 'false';
        }else{
            return false;
        }
        
    }

}