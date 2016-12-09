<?php

namespace App\Http\Repositories;
use App\Entities\Asesor;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class AsesorRepo extends BaseRepo {

    public function getModel()
    {
        return new Asesor();
    }


    public function check($tipo,$nro){
        return $this->model->where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($asesor){
        $asesor->activo = 0;
        return $asesor->save();
    }
    
}