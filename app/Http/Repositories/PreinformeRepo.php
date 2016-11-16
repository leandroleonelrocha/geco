<?php

namespace App\Http\Repositories;
use App\Entities\Preinforme;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PreinformeRepo extends BaseRepo {

    public function getModel()
    {
        return new Preinforme();
    }

    public function allFilial(){
        $filial = session('usuario')['entidad_id'];
        return Preinforme::where('filial_id', $filial)->get();
    }

    public function estadisticas($inicio, $fin){


    $filial = session('usuario')['entidad_id'];
    return $this->model->where('filial_id', $filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin);
    }

    

}