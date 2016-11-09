<?php

namespace App\Http\Repositories;
use App\Entities\AsesorFilial;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class AsesorFilialRepo extends BaseRepo {

    public function getModel()
    {
        return new AsesorFilial();
    }

    public function allAsesorFilial(){
        $filial = session('usuario')['entidad_id'];
        return AsesorFilial::where('filial_id', $filial)->get(); //consultar estado activo
    }

    public function deleteAsesor($id){

        $filial = session('usuario')['entidad_id'];
        return AsesorFilial::where('asesor_id', '=', $id)->where('filial_id', '=', $filial)->delete();
    }
}

         
           
            
           