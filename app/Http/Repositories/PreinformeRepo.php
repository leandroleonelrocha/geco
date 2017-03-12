<?php

namespace App\Http\Repositories;
use App\Entities\Preinforme;
use App\Entities\Matricula;
use App\Entities\Filial;
use App\Entities\Asesor;
use App\Entities\Carrera;
use App\Entities\Curso;
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
        /*
        $qry         = Preinforme::leftJoin('persona', 'persona.id', '=', 'preinforme.persona_id')
                         //->whereDate('created_at','>=', $dia_inicio_mes)
                         //->whereDate('created_at','<=', $dia_fin_mes)  
                         //->select(DB::raw('COUNT(id) as total,DATE_FORMAT(created_at,"%d/%m/%Y") as fecha,persona_id'))
                         ->groupBy('persona.created_at')
                         ->where('filial_id',$this->filial)
                         ->get();
                 
      */
       $fechas =[];                    

        for($i = $dia_inicio_mes; $i <= $dia_fin_mes; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
            
            array_push($fechas, $i);
        }
       return $fechas;

    }
    /*
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
    */

    public function estadisticasAsesor(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry  = Asesor::where('asesor.filial_id',$this->filial)
                        //->join('asesor','asesor.id','=','matricula.asesor_id')
                        //->whereDate('matricula.created_at','>=', $dia_inicio_mes)
                        //->whereDate('matricula.created_at','<=', $dia_fin_mes)  
                        //->select(DB::raw('COUNT(asesor_id) as total,asesor.nombres as nombre'))
                        //->groupBy('matricula.asesor_id')
                        ->get();
        /*
        foreach ($qry as $value) {
             # code...
            $matricula  = $value->Matricula()->whereDate('created_at', '>=', $dia_inicio_mes)->whereDate('created_at','<=', $dia_fin_mes)->get();
            $preinforme = $value->Preinforme()->whereDate('created_at', '>=', $dia_inicio_mes)->whereDate('created_at','<=', $dia_fin_mes)->get(); 
         }
        */

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
       
        /*
        $qry         =  Preinforme::where('preinforme.filial_id',$this->filial)
                        ->join('persona_interes','persona_interes.preinforme_id','=','preinforme.id')
                        ->join('curso', 'persona_interes.curso_id', '=', 'curso.id')
                        ->whereDate('persona_interes.created_at','>=', $dia_inicio_mes)
                        ->whereDate('persona_interes.created_at','<=', $dia_fin_mes)  
                        ->select(DB::raw('COUNT(curso_id) as total,curso.nombre,persona_interes.persona_id,persona_interes.curso_id'))
                        ->where('persona_interes.curso_id','<>','null')
                        ->groupBy('persona_interes.curso_id')
                        ->get();
        */
        $filial = Filial::find($this->filial);
        $qry = Curso::where('cadena_id', $filial->Cadena->id)->where('lenguaje',$this->lenguaje)->get();
                    
        return $qry;   
    }

     public function estadisticasCarrera(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();
        /*
        $qry         = Preinforme::where('preinforme.filial_id', $this->filial)
                        ->join('persona_interes','persona_interes.preinforme_id','=','preinforme.id')
                        ->join('carrera', 'persona_interes.carrera_id', '=', 'carrera.id')
                        ->select(DB::raw('COUNT(carrera_id) as total,carrera.nombre,persona_interes.persona_id,persona_interes.carrera_id'))
                        ->where('persona_interes.carrera_id','<>','null')
                        ->whereDate('persona_interes.created_at','>=', $dia_inicio_mes)
                        ->whereDate('persona_interes.created_at','<=', $dia_fin_mes)
                        ->groupBy('persona_interes.carrera_id')
                        ->get();
                        
        return $qry;
        */
        $filial = Filial::find($this->filial);
        $qry = Carrera::where('cadena_id', $filial->Cadena->id)->where('lenguaje',$this->lenguaje)->get();
        
        return $qry;

       }

}