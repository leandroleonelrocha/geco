<?php

namespace App\Http\Repositories;
use App\Entities\Pago;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PagoRepo extends BaseRepo {

    public function getModel()
    {
        return new Pago();
    }

    public function allFilial(){

        return $this->model->where('filial_id', $this->filial)->get();
    }

    public function allMatricula($id){
        return $this->model->where('matricula_id', $id)->get();
    }

    //SELECT DE TODOS LOS MOROSOS ENTRE FECHAS DE LA MISMA FILIAL
    public function allMorososEntreFechas($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);
        $fecha_hoy   = date("Y-m-d H:i:s");
        $filial_id   = $this->filial;   
        return $this->model->where('vencimiento','>',$fecha_hoy)->where('filial_id',$filial_id)->whereBetween('created_at', array($from, $to))->get();
    }
}