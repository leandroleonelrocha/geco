<?php

namespace App\Http\Repositories;
use App\Entities\Pago;
use App\Entities\Recibo;
use App\Entities\Grupo;
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
        return $this->model->where('vencimiento','>',$fecha_hoy)
                           ->where('terminado',0)
                           ->where('filial_id',$filial_id)
                           ->whereDate('created_at','>=',$from)
                           ->whereDate('created_at','<=',$to)
                           ->get();
    }

    //SELECT LIBRO IVA ENTRE FECHAS DE LA MISMA FILIAL
    public function libroIvaEntreFechas($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);

        $filial_id   = $this->filial;   
        return Recibo::where('filial_id',$filial_id)
                     //->whereBetween('created_at', array($from, $to))
                     ->whereDate('created_at','>=',$from)
                     ->whereDate('created_at','<=',$to)
                     ->get();
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
                         
        return $qry;      
    }

    public function totalEntreFechas($valor){
        $from        = helpersfuncionFecha($valor[0]);
        $to          = helpersfuncionFecha($valor[1]);
        $filial_id   = $this->filial; 

        $qry         = DB::table('recibo')
                         ->join('filial', 'recibo.filial_id', '=', 'filial.id')
                         //->join('recibo_tipo', 'recibo.recibo_tipo_id', '=', 'recibo_tipo.id')
                         //->join('recibo', 'recibo.pago_id', '=', 'recibo.id')
                         ->select(DB::raw('SUM(recibo.monto) as total'))
                         //->where('terminado',1)
                         //->groupBy('recibo.recibo_tipo_id')
                         ->get();
                         
        return $qry;
    }

        public function totalPorGrupo(){
       // $from        = helpersfuncionFecha($valor[0]);
        //$to          = helpersfuncionFecha($valor[1]);
        $filial_id   = $this->filial; 
        /*
        
        $qry         = DB::table('recibo')
                         ->join('pago', 'recibo.pago_id', '=', 'pago.id')
                         ->join('recibo_tipo', 'recibo.recibo_tipo_id', '=', 'recibo_tipo.id')
                         ->join('matricula', 'pago.matricula_id', '=','matricula.id')
                         ->join('grupo_matricula', 'matricula.id', '=', 'grupo_matricula.matricula_id')
                         ->join('grupo', 'grupo_matricula.grupo_id', '=','grupo.id')   
                         ->select(DB::raw('recibo_tipo.recibo_tipo,grupo.descripcion as grupo,SUM(grupo_matricula.grupo_id) as Countgrupo_id'))
                         ->groupBy('grupo_matricula.grupo_id,recibo_tipo.id')
                         ->get();                 
        //select(DB::raw('recibo_tipo.recibo_tipo,grupo.descripcion as grupo,SUM(recibo.monto) as total'))
        $qry         = Recibo::join('pago', 'pago.id', '=', 'recibo.pago_id')
                         ->join('recibo_tipo', 'recibo.recibo_tipo_id', '=', 'recibo_tipo.id')
                         //->where('recibo.recibo_tipo_id',1)
                         ->join('matricula', 'pago.matricula_id', '=', 'matricula.id')
                         ->join('grupo_matricula', 'matricula.id', '=','grupo_matricula.matricula_id')
                         ->join('grupo','grupo.id','=','grupo_matricula.grupo_id')
                         ->groupBy('grupo_matricula.grupo_id')
                         ->get();
        */


        $qry         = Recibo::join('pago', 'pago.id', '=', 'recibo.pago_id')
       ->select(DB::raw('recibo_tipo.recibo_tipo,grupo.descripcion as grupo,SUM(recibo.monto) as total'))
                         ->join('recibo_tipo', 'recibo.recibo_tipo_id', '=', 'recibo_tipo.id')
                         //->where('recibo.recibo_tipo_id',1)
                         ->join('matricula', 'pago.matricula_id', '=', 'matricula.id')
                         ->join('grupo_matricula', 'matricula.id', '=','grupo_matricula.matricula_id')
                         ->join('grupo','grupo.id','=','grupo_matricula.grupo_id')
                         ->groupBy('grupo_matricula.grupo_id','recibo_tipo_id')
                         ->get();
                        
        return $qry;      
    }

    

}