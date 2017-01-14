<?php

namespace App\Http\Repositories;
use App\Entities\Filial;
use App\Entities\Examen;
use App\Entities\Pago;

use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;
class FilialRepo extends BaseRepo {

    public function getModel(){
        return new Filial();
    }

    public function allEneable(){
        return $this->model->where('activo', 1)->get();
    }

    public function allFilialDirector(){
        $d = session('usuario')['entidad_id'];
        return $this->model->where('director_id', $d)->get();
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

    public function check($mail){
        return $this->model->where('mail', $mail)->update(['activo'=>1]);
    }

    public function existeMail($mail){
        return $this->model->where('mail', $mail)->first();
    }
    
    public function allFilial($cadena){
        return $this->model->where('cadena_id',$cadena)->where('id', '!=', $this->filial)->get();
    }

     public function estadisticasExamen($inicio, $fin){
         $qry         = DB::table('examen')
                         ->join('grupo', 'examen.grupo_id', '=', 'grupo.id')
                         ->join('matricula', 'examen.matricula_id', '=', 'matricula.id')
                         ->where('matricula.filial_id', $this->filial)
                         ->select(DB::raw('AVG(nota) as promedio, examen.nro_acta, grupo.descripcion, COUNT(nro_acta) as cantidad' ))
                         ->orderBy('nro_acta', 'DESC')
                         ->groupBy('nro_acta')

                         ->get();
       return $qry;

    }



    public function estadisticasMorosidad($inicio, $fin){
        $fecha_hoy   = date("Y-m-d H:i:s");
        $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('filial_id', $this->filial)
                         ->where('vencimiento', '>', $fecha_hoy)
                         ->where('terminado',0)
                         ->groupBy('filial_id')
                         ->get();
        return  $qry;
    }

     public function montoTotalMorosidad($inicio, $fin){
     
        $fecha_hoy   = date("Y-m-d H:i:s");
        return Pago::whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('filial_id',$this->filial)->where('vencimiento', '>', $fecha_hoy)->where('terminado',0)->sum('monto_actual');
    }

      public function montoTotalRecaudacion($inicio, $fin){
         return Pago::whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('filial_id',$this->filial)->where('terminado',1)->sum('monto_actual');
    }

     public function estadisticasRecaudacion($inicio, $fin){

        $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('filial_id', $this->filial)
                         ->where('terminado',1)
                         ->groupBy('filial_id')
                         ->get();
        return $qry;  

    }


}