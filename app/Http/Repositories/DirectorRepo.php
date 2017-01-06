<?php

namespace App\Http\Repositories;
use App\Entities\Director;
use App\Entities\Filial;
use App\Entities\Asesor;
use DB;
use App\Entities\Persona;
use App\Entities\Pago;
use App\Entities\Preinforme;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\PersonaRepo;

class DirectorRepo extends BaseRepo {

    public function getModel(){
        return new Director();
    }

    public function check($mail){
    	return $this->model->where('mail', $mail)->update(['activo'=>1]);
    }

    public function disable($director){
    	$director->activo = 0;
    	return $director->save();
    }

    public function existeMail($mail){
        return $this->model->where('mail', $mail)->first();
    }
    
    public function filialDirectores(){
        $email    = session('usuario')['usuario'];
        $director = $this->model->where('activo', 1)->where('mail', $email)->first();
        
        $data_id  = [];
        foreach ($director->Filial as $value) {
            array_push($data_id, $value->id);
        }
        return $data_id;

    }

    public function allDirectorCadena($cadena){
        return DB::table('director')
                   ->join('filial', 'director.id', '=', 'filial.director_id')
                   ->select('*')
                   ->whereIn('filial.cadena_id', $cadena)
                   ->get();
    }

    public function countTotal($inicio, $fin){
        $filial_id = $this->filialDirectores();
        return Persona::whereIn('filial_id', $filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }

    public function countTotalPersonas(){
        $filial_id = $this->filialDirectores();
        return Persona::whereIn('filial_id', $filial_id)->get()->count();
    }

    public function countTotalAsesores(){
        $filial_id = $this->filialDirectores();
        return Asesor::whereIn('filial_id', $filial_id)->get()->count();
    }



    public function getGenero($inicio, $fin){

        $filial_id = $this->filialDirectores();
        $query = Persona::whereIn('filial_id', $filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('genero');
        
        $resultado=[];
        foreach ($query as $qry => $q)
        {     
            if($qry == 'M')
              $data['nombre'] = 'Masculino';
            if($qry == 'F')
              $data['nombre'] = 'Femenino';

            $data['count'] = $q->count();
            array_push($resultado, $data);
        }

        return $resultado;
    }

    public function estadisticasNivelEstudios($inicio, $fin){

        $filial_id = $this->filialDirectores();  
        return Persona::whereIn('filial_id', $filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('nivel_estudios');
    }

    public function estadisticasPreInformes($inicio, $fin){
        $filial_id = $this->filialDirectores();      
        return Preinforme::whereIn('filial_id', $filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin);
    }

    public function estadisticasPersonas($campo, $valor, $inicio, $fin){

      $filial_id = $this->filialDirectores();
      return Persona::whereIn('filial_id',$filial_id)->where($campo,$valor)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }

    public function estadisticasRecaudacion($inicio, $fin){
         $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->where('filial.director_id', $this->filial )
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('terminado',1)
                         ->groupBy('filial_id')
                         ->get();
        return $qry;    
    }
    public function totalRecaudacion($inicio, $fin){
      $filial_id = $this->filialDirectores();
      return Pago::whereIn('filial_id',$filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('terminado',1)->sum('monto_actual');
    }

    public function estadisticasMorosidad($inicio, $fin){
        $fecha_hoy   = date("Y-m-d H:i:s");
        $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->where('filial.director_id', $this->filial )
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('vencimiento', '>', $fecha_hoy)
                         ->where('terminado',0)
                         ->groupBy('filial_id')
                         ->get();
       return $qry;
    }

    public function totalMorosidad($inicio, $fin){
      $fecha_hoy   = date("Y-m-d H:i:s");  
      $filial_id = $this->filialDirectores();
      return Pago::whereIn('filial_id',$filial_id)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('vencimiento', '>', $fecha_hoy)->where('terminado',0)->sum('monto_actual');
    }

    public function estadisticasExamen($inicio, $fin){
         $qry         = DB::table('examen')
                         ->join('grupo', 'examen.grupo_id', '=', 'grupo.id')
                         ->join('matricula', 'examen.matricula_id', '=', 'matricula.id')
                         ->where('matricula.filial_id', $this->filial)
                         ->select(DB::raw('AVG(nota) as promedio, examen.nro_acta' ))
                         ->groupBy('nro_acta')
                         ->get();
       dd($qry);

    }
}