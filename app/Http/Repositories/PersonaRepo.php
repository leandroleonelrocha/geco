<?php

namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PersonaRepo extends BaseRepo {

    
    public function getModel()
    {
        return new Persona();
    }


    public function allEneable(){

        return Persona::where('activo', 1)->get();
    }

    public function check($tipo,$nro){
        return Persona::where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($asesor){
        $asesor->activo = 0;
        return $asesor->save();
    }

    public function getPersonasFilial(){
    	$filial = session('usuario')['entidad_id'];
        return Persona::where('filial_id', $filial)->get();
    }

    public function countTotal()
    {
        $filial = session('usuario')['entidad_id'];
        return $this->model->where('filial_id', $filial)->get()->count();
    }

    public function getGenero($inicio, $fin)
    {
        $filial = session('usuario')['entidad_id'];
        $query = $this->model->where('filial_id', $filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('genero');
        $resultado=[];
        foreach ($query as $qry => $q)
        {
                $data['nombre'] = $qry;
                $data['count'] = $q->count();
                array_push($resultado, $data);
        }
        return $resultado;
        //return response()->json($resultado, 200);
    }

    public function getPoseeComputadora($inicio, $fin)
    {
        $label = 'Posee computadora';
        $filial = session('usuario')['entidad_id'];
        $si = $this->model->where('filial_id', $filial)->where('posee_computadora',1)->get()->count();
        $no = $this->model->where('filial_id', $filial)->where('posee_computadora', 0)->get()->count();
        $data = $label.','.$si.','.$no;
        
        return $data;
    }

    public function getEstudioComputadora($inicio, $fin)
    {
        $label = 'Estudio computadora';
        $filial = session('usuario')['entidad_id'];
        $si = $this->model->where('filial_id', $filial)->where('estudio_computacion',1)->get()->count();
        $no = $this->model->where('filial_id', $filial)->where('estudio_computacion', 0)->get()->count();
        $data = $label.','.$si.','.$no;
        
        return $data;
    }

        

}