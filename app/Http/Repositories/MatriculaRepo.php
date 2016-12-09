<?php

namespace App\Http\Repositories;
use App\Entities\Matricula;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

class MatriculaRepo extends BaseRepo {

    public function getModel()
    {
        return new Matricula();
    }
    
    public function allEneable(){
        return $this->model->where('activo', 1)->where('filial_id', $this->filial)->paginate(10);
    }

    public function disable($matricula){
        $matricula->activo = 0;
        return $matricula->save();
    }

    public function allPasesSend(){
        return DB::table('matricula')
                   ->join('matricula_permisos', 'matricula.id', '=', 'matricula_permisos.matricula_id')
                   ->join('filial', 'filial.id', '=', 'matricula_permisos.filial_id')
                   ->join('persona', 'persona.id', '=', 'matricula.persona_id')
                   ->select('matricula.id as matricula','filial.nombre as filial', 'persona.nombres', 'persona.apellidos', 'matricula_permisos.confirmar')
                   ->where('matricula.filial_id', $this->filial)
                   ->where('matricula_permisos.filial_id', '!=', $this->filial)
                   ->orderBy('matricula_permisos.confirmar')
                   ->get();
    }
}

/*
    Pases Enviados

    select matricula.id as matricula, filial.nombre as filial, persona.nombres, persona.apellidos, matricula_permisos.confirmar
    from matricula
    inner join matricula_permisos on matricula.id = matricula_permisos.matricula_id
    inner join filial on filial.id = matricula_permisos.filial_id
    inner join persona on persona.id = matricula.persona_id
    where matricula.filial_id = 3 and matricula_permisos.filial_id != 3
    order by matricula_permisos.confirmar
*/