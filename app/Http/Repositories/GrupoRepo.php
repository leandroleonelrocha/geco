<?php

namespace App\Http\Repositories;
use App\Entities\Grupo;
use App\Http\Repositories\BaseRepo;

class GrupoRepo extends BaseRepo {

    public function getModel()
    {
        return new Grupo();
    }
    
    public function allEnable(){

        return $this->model->where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->where('cancelado', 0)->get();
    }
}