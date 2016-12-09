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
        return $this->model->where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->paginate(10);
    }

    public function allCancelado(){
        return $this->model->where('filial_id', $this->filial)->where('activo', 0)->where('terminado', 0)->where('cancelado', 0)->get();
    }

    public function allNuevo(){
        return Grupo::where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->where('nuevo', 1)->get();
    }
}