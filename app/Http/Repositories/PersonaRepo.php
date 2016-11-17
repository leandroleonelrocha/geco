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

    protected function baseWhere($campo,$valor,$inicio,$fin){
        $filial = session('usuario')['entidad_id'];
        return $this->model->where('filial_id', $filial)->where($campo,$valor)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
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
        $si = $this->baseWhere('posee_computadora',1,$inicio,$fin);
        $no = $this->baseWhere('posee_computadora',0,$inicio,$fin);
        return $label.','.$si.','.$no;
        
    }

    public function getEstudioComputadora($inicio, $fin)
    {
        $label = 'Estudio computacion';
        $si = $this->baseWhere('estudio_computacion',1,$inicio,$fin);
        $no = $this->baseWhere('estudio_computacion',0,$inicio,$fin);
        return $label.','.$si.','.$no;
        
    }

    public function disponibilidadManana($inicio, $fin)
    {
        $label = 'Disponibilidad manana';
        $filial = session('usuario')['entidad_id'];
        $si = $this->baseWhere('disponibilidad_manana',1,$inicio,$fin);
        $no = $this->baseWhere('disponibilidad_manana',0,$inicio,$fin);
        return $label.','.$si.','.$no;
           
    }

    
    public function disponibilidadTarde($inicio, $fin)
    {
        $label = 'Disponibilidad tarde';
        $si = $this->baseWhere('disponibilidad_tarde',1,$inicio,$fin);
        $no = $this->baseWhere('disponibilidad_tarde',0,$inicio,$fin);
        return $label.','.$si.','.$no;
           
    }

    public function disponibilidadNoche($inicio, $fin)
    {
        $label = 'Disponibilidad noche';
        $si = $this->baseWhere('disponibilidad_noche',1,$inicio,$fin);
        $no = $this->baseWhere('disponibilidad_noche',0,$inicio,$fin);
        return $label.','.$si.','.$no;
           
    }

    public function disponibilidadSabado($inicio, $fin)
    {
        $label = 'Disponibilidad sabados';
        $si = $this->baseWhere('disponibilidad_sabados',1,$inicio,$fin);
        $no = $this->baseWhere('disponibilidad_sabados',0,$inicio,$fin);
        return $label.','.$si.','.$no;
       
    }
        

}