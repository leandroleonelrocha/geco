<?php

namespace App\Http\Repositories;
use App\Entities\Filial;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class FilialRepo extends BaseRepo {

    public function getModel()
    {
        return new Filial();
    }

    public function allEneable(){

        return Filial::where('activo', 1)->get();
    }
  
    public function disable($filial){
        $filial->activo = 0;
        return $filial->save();
    }
}