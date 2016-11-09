<?php

namespace App\Http\Repositories;
use App\Entities\Director;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class DirectorRepo extends BaseRepo {

    public function getModel()
    {
        return new Director();
    }

    public function allEneable(){

        return Director::where('activo', 1)->get();
    }

    public function check($tipo,$nro){
    	return Director::where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($director){
    	$director->activo = 0;
    	return $director->save();
    }

}