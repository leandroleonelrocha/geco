<?php

namespace App\Http\Repositories;
use App\Entities\Preinforme;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;
class PreinformeRepo extends BaseRepo {

    public function getModel()
    {
        return new Preinforme();
    }

    public function allFilial(){

        return $this->model->where('filial_id', $this->filial)->get();
    }

    public function estadisticas($inicio, $fin){
        return $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin);
    }

    
    public function estadisticasMes(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry         = Preinforme::whereDate('created_at','>=', $dia_inicio_mes)
                          ->whereDate('created_at','<=', $dia_fin_mes)  
       ->select(DB::raw('COUNT(id) as total,DATE_FORMAT(created_at,"%d/%m/%Y") as fecha,persona_id'))
                         ->groupBy('created_at')
                         ->where('filial_id',$this->filial)
                         ->get();
                        
        return $qry;   
    }

    public function estadisticasAsesor(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry         = Preinforme::whereDate('created_at','>=', $dia_inicio_mes)
                          ->whereDate('created_at','<=', $dia_fin_mes)  
       ->select(DB::raw('COUNT(asesor_id) as total,asesor_id,persona_id'))
                         ->groupBy('asesor_id')
                         ->where('filial_id',$this->filial)
                         ->get();
                        
        return $qry;   
    }

     public function estadisticasMedio(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry         = Preinforme::whereDate('created_at','>=', $dia_inicio_mes)
                          ->whereDate('created_at','<=', $dia_fin_mes)  
       ->select(DB::raw('COUNT(medio_id) as total,persona_id,medio_id'))
                         ->groupBy('medio_id')
                         ->where('filial_id',$this->filial)
                         ->get();
                        
        return $qry;   
    }

    public function estadisticasCurso(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry         = Preinforme::join('persona_interes', 'persona_interes.id', '=', 'preinforme.id')
                        //->join('curso','curso.id','persona_interes.curso_id')
                        ->join('curso', 'persona_interes.curso_id', '=', 'curso.id')
                        ->whereDate('preinforme.created_at','>=', $dia_inicio_mes)
                        ->whereDate('preinforme.created_at','<=', $dia_fin_mes)  
                        ->select(DB::raw('COUNT(curso_id) as total,curso.nombre,preinforme.persona_id'))
                        ->where('persona_interes.curso_id','<>','null')
                        ->groupBy('persona_interes.curso_id')
                        ->where('preinforme.filial_id',$this->filial)
                        ->get();
                        
        return $qry;   
    }

     public function estadisticasCarrera(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry         = Preinforme::join('persona_interes', 'persona_interes.id', '=', 'preinforme.id')
                        ->join('carrera', 'persona_interes.carrera_id', '=', 'carrera.id')
                        ->whereDate('preinforme.created_at','>=', $dia_inicio_mes)
                        ->whereDate('preinforme.created_at','<=', $dia_fin_mes)  
                        ->select(DB::raw('COUNT(carrera_id) as total,carrera.nombre,preinforme.persona_id'))
                        ->where('persona_interes.carrera_id','<>','null')
                        ->groupBy('persona_interes.carrera_id')
                        ->where('preinforme.filial_id',$this->filial)
                        ->get();
                        
        return $qry;   
    }

}