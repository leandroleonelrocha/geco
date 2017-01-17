<?php

namespace App\Http\Repositories;
use App\Entities\Pago;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function allMatriculaPlan($id){
        return $this->model->where('matricula_id', $id)->where('pago_individual', 0)->get();
    }

    public function allMatriculaIndividual($id){
        return $this->model->where('matricula_id', $id)->where('pago_individual', 1)->get();
    }

    //SELECT DE TODOS LOS MOROSOS ENTRE FECHAS DE LA MISMA FILIAL
    public function allMorososEntreFechas($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);
        $fecha_hoy   = date("Y-m-d H:i:s");
        $filial_id   = $this->filial;   
        return $this->model->where('vencimiento','>',$fecha_hoy)->where('terminado',0)->where('filial_id',$filial_id)->whereBetween('created_at', array($from, $to))->get();
    }

    //SELECT LIBRO IVA ENTRE FECHAS DE LA MISMA FILIAL
    public function libroIvaEntreFechas($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);
        $filial_id   = $this->filial;   
        return $this->model->where('terminado',1)->where('filial_id',$filial_id)->whereBetween('created_at', array($from, $to))->get();
    }

    public function totalPorRecibo($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);
        $filial_id   = $this->filial; 

        $qry         = DB::table('recibo')
                         ->join('filial', 'recibo.filial_id', '=', 'filial.id')
                         ->join('recibo_tipo', 'recibo.recibo_tipo_id', '=', 'recibo_tipo.id')
                         //->join('recibo', 'recibo.pago_id', '=', 'recibo.id')
                         ->select(DB::raw('SUM(recibo.monto) as total, recibo_tipo.recibo_tipo as recibo'))
                         
                         //->where('terminado',1)
                         ->groupBy('recibo.recibo_tipo_id')
                         ->get();
        dd($qry);                 
        //return $qry;      
    }

}