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

        return $this->model->where('filial_id', $this->filial)->get();
    }

    public function estadisticas($inicio, $fin){
        return $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin);
    }

    
    

}