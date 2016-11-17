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
        return $this->model->where('activo',1)->get();
    }

    public function check($tipo,$nro){
        return $this->model->where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($asesor){
        $asesor->activo = 0;
        return $asesor->save();
    }

    public function getPersonasFilial(){
       return $this->model->where('filial_id', $this->filial)->get();
    }

    public function countTotal()
    {
        return $this->model->where('filial_id', $this->filial)->get()->count();
    }

    public function getGenero($inicio, $fin)
    {
      
        $query = $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('genero');
        $resultado=[];
        foreach ($query as $qry => $q)
        {
                $data['nombre'] = $qry;
                $data['count'] = $q->count();
                array_push($resultado, $data);
        }
        return $resultado;

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