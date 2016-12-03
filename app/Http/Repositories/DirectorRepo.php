<?php

namespace App\Http\Repositories;
use App\Entities\Director;
use App\Entities\Filial;
use App\Entities\AsesorFilial;

use App\Entities\Persona;
use App\Entities\Preinforme;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\PersonaRepo;

class DirectorRepo extends BaseRepo {

    public function getModel(){
        return new Director();
    }

    public function allEneable(){
        return $this->model->where('activo', 1)->get();
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
        return AsesorFilial::whereIn('filial_id', $filial_id)->get()->count();
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

}