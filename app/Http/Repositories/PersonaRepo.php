<?php

namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PersonaRepo extends BaseRepo {

    public function getModel()
    {
        return new Persona();
    }

    public function allEneable(){

        return Persona::where('activo', 1)->get();
    }

    public function check($tipo,$nro){
        return Persona::where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($asesor){
        $asesor->activo = 0;
        return $asesor->save();
    }

    public function getPersonasFilial(){
    	$filial = session('usuario')['entidad_id'];
        return Persona::where('filial_id', $filial)->get();
    }
}