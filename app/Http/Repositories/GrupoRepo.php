<?php

namespace App\Http\Repositories;
use App\Entities\Grupo;
use App\Entities\Clase;
use App\Http\Repositories\BaseRepo;

class GrupoRepo extends BaseRepo {

    public function getModel()
    {
        return new Grupo();
    }
    
    public function allEnable(){
        return $this->model->where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->get();
    }

    public function allCancelado(){
        return $this->model->where('filial_id', $this->filial)->where('activo', 0)->where('terminado', 0)->where('cancelado', 0)->get();
    }

    public function allNuevo(){
        return Grupo::where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->where('nuevo', 1)->get();
    }

    public function allGruposCarrera($id){
        return $this->model->where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->where('carrera_id', $id)->get();
    }

    public function allGruposCurso($id){
        return $this->model->where('filial_id', $this->filial)->where('activo', 1)->where('terminado', 0)->where('curso_id', $id)->get();
    }

    public function grupo_carrera_o_curso($valor)
    {
            $carrearas_cursos = explode(';',$valor);
            if ($carrearas_cursos[0] == 'carrera')
                $data['carrera_id']    =   $carrearas_cursos[1];
            elseif ($carrearas_cursos[0] == 'curso')
                $data['curso_id']      =   $carrearas_cursos[1];
            return $data;
    }

    public function clasesMesActual(){
        $dia_inicio_mes = first_day_month();
        $dia_fin_mes    = last_day_month();

        $qry =  Clase::where('grupo_id', 1)
                ->whereDate('clase.fecha','>=', $dia_inicio_mes)
                ->whereDate('clase.fecha','<=', $dia_fin_mes)
                ->get();

                        
        return $qry;   
    }

  

}