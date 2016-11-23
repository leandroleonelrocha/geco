<?php

namespace App\Http\Repositories;
use App\Entities\Filial;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;
class FilialRepo extends BaseRepo {

    public function getModel()
    {
        return new Filial();
    }

    public function allEneable(){

        return $this->model->where('activo', 1)->get();
    }
  
    public function disable($filial){
        $filial->activo = 0;
        return $filial->save();
    }

    public function filialCadena(){
        return DB::table('filial')->select('cadena_id')->where('id', $this->filial)->first();
    }

    public function allFilialCadena($cadena){
        return $this->model->where('cadena_id',$cadena)->get();
    }

    public function allFilial($cadena){
        return $this->model->where('cadena_id',$cadena)->where('id', '!=', $this->filial)->get();
    }
}