<?php

namespace App\Http\Repositories;
use App\Entities\Clase;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

class ClaseRepo extends BaseRepo {

    public function getModel(){
        return new Clase();
    }

    public function findAllClaseGrupo($grupo){
        return $this->model->where('grupo_id', $grupo)->get();
    }

    public function allCancelado(){
        return $this->model->where('clase_estado_id', 2)->where('enviado', 0)->get();
    }
    
    public function clasesDocente($id,$fecha1,$fecha2){
    	$date=date(("Y/m/d"));
    	// $date='2016-11-26 00:00:00.000000';
        return $this->model->where('fecha','<',$fecha2 )
                           ->where('fecha','>',$fecha1)
                           ->where('docente_id', $id)
                           ->get();
        // return DB::table('clase')
        //  ->where('fecha','<',$fecha2 )
        //   ->where('fecha','>',$fecha1)
        //  ->where('docente_id', $id)
        //  ->get();
     }

}