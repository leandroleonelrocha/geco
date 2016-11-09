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
        $filial = session('usuario')['entidad_id'];
        return Grupo::where('filial_id', $filial)->where('activo', 1)->where('terminado', 0)->where('cancelado', 0)->get();
    }
}