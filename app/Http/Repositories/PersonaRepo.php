<?php

namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

class PersonaRepo extends BaseRepo {
    
    public function getModel(){
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
    	$filial = session('usuario')['entidad_id'];
      return Persona::where('filial_id', $filial)->get();
    }

    public function countTotal($inicio, $fin){
        return $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }

    public function getGenero($inicio, $fin){
      
        $query = $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('genero');
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

      return $this->model->where('filial_id', $this->filial)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('nivel_estudios');
    }

    public function estadisticasPersonas($campo, $valor, $inicio, $fin){
      return $this->model->where($campo,$valor)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }

    public function allPreMorosos(){
      return DB::table('persona')
                   ->join('persona_mail',   'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('matricula',      'persona.id',   '=', 'matricula.persona_id')
                   ->join('pago',           'matricula.id', '=', 'pago.matricula_id')
                   ->select('persona.id as pe_id', 'persona.nombres', 'persona.apellidos', 'mail', 'pago.id as pa_id', 'pago.vencimiento', 'pago.recargo', 'pago.matricula_id', 'pago.nro_pago', 'matricula.ultimo_mail_enviado')
                   ->where('pago.terminado', 0)
                   ->where('matricula.ultimo_mail_enviado', '<', date('Y-m-d'))
                   ->where('persona.filial_id', $this->filial)
                   ->where('matricula.filial_id', $this->filial)
                   ->where('matricula.activo', 1)
                   ->where('matricula.cancelado', 0)
                   ->where(DB::raw("DATEDIFF(pago.vencimiento, '".date('Y-m-d')."')"), '<=', 10)
                   ->where(DB::raw("DATEDIFF(pago.vencimiento, '".date('Y-m-d')."')"), '>=',  0)
                   ->get();
    }
  
    public function allMorosos(){
        return DB::table('persona')
                   ->join('persona_mail',   'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('matricula',      'persona.id',   '=', 'matricula.persona_id')
                   ->join('pago',           'matricula.id', '=', 'pago.matricula_id')
                   ->select('persona.id as pe_id', 'persona.nombres', 'persona.apellidos', 'mail', 'pago.id as pa_id', 'pago.vencimiento', 'pago.recargo', 'pago.matricula_id', 'pago.nro_pago', 'matricula.ultimo_mail_enviado')
                   ->where('pago.vencimiento', '<', date('Y-m-d'))
                   ->where('pago.terminado', 0)
                   ->where('matricula.ultimo_mail_enviado', '<', date('Y-m-d'))
                   ->where('persona.filial_id', $this->filial)
                   ->where('matricula.filial_id', $this->filial)
                   ->where('matricula.activo', 1)
                   ->where('matricula.cancelado', 0)
                   ->get();
    }

    public function allInteresCursoGrupo(){
      return DB::table('persona')
                   ->join('persona_mail',    'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('persona_interes', 'persona.id',   '=', 'persona_interes.persona_id')
                   ->join('curso',           'curso.id',     '=', 'persona_interes.curso_id')
                   ->join('grupo',           'curso.id',     '=', 'grupo.curso_id')
                   ->select('persona.id', 'persona_mail.mail', 'curso.nombre as curso')
                   ->where('grupo.nuevo', 1)
                   ->where('persona.filial_id', $this->filial)
                   ->where('grupo.filial_id', $this->filial)
                   ->get();
    }

    public function allInteresCarreraGrupo(){
      return DB::table('persona')
                   ->join('persona_mail',    'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('persona_interes', 'persona.id',   '=', 'persona_interes.persona_id')
                   ->join('carrera',         'carrera.id',   '=', 'persona_interes.carrera_id')
                   ->join('grupo',           'carrera.id',   '=', 'grupo.carrera_id')
                   ->select('persona.id', 'persona_mail.mail', 'carrera.nombre as carrera', 'carrera.duracion')
                   ->where('grupo.nuevo', 1)
                   ->where('persona.filial_id', $this->filial)
                   ->where('grupo.filial_id', $this->filial)
                   ->get();
    }   
}

/*
------------------------------------------------------------------------------------------

Todos los Pre-Morosos

select persona.id as pe_id, persona.nombres, persona.apellidos, mail, pago.id as pa_id, pago.vencimiento, pago.matricula_id, pago.nro_pago, matricula.ultimo_mail_enviado
from persona
inner join persona_mail ON persona.id = persona_mail.persona_id
inner join matricula ON persona.id = matricula.persona_id
inner join pago ON matricula.id = pago.matricula_id
where DATEDIFF(pago.vencimiento, CURRENT_DATE) <= 10 and
      DATEDIFF(pago.vencimiento, CURRENT_DATE) >= 0 and
      pago.terminado = 0 and 
      matricula.ultimo_mail_enviado < CURRENT_DATE and
      persona.filial_id = 3 and
      matricula.filial_id = 3 and
      matricula.activo = 1 and
      matricula.cancelado = 0

------------------------------------------------------------------------------------------

Todos los Morosos

select persona.id as pe_id, persona.nombres, persona.apellidos, mail, pago.id as pa_id, pago.vencimiento, pago.matricula_id, pago.nro_pago, matricula.ultimo_mail_enviado
from persona
inner join persona_mail ON persona.id = persona_mail.persona_id
inner join matricula ON persona.id = matricula.persona_id
inner join pago ON matricula.id = pago.matricula_id
where pago.vencimiento < CURRENT_DATE and pago.terminado = 0 and 
      matricula.ultimo_mail_enviado < CURRENT_DATE and
      persona.filial_id = 3 and
      matricula.filial_id = 3 and
      matricula.activo = 1 and
      matricula.cancelado = 0

------------------------------------------------------------------------------------------

Todas las personas que tienen de interes un curso de un grupo nuevo

select persona.id, persona_mail.mail, curso.nombre as curso
from persona
inner join persona_mail on persona.id = persona_mail.persona_id
inner join persona_interes on persona.id = persona_interes.persona_id
inner join curso on curso.id = persona_interes.curso_id
inner join grupo on grupo.curso_id = curso.id
where grupo.nuevo = 1 and 
      persona.filial_id = 3 and 
      grupo.filial_id = 3

------------------------------------------------------------------------------------------

Todas las personas que tienen de interes una carrera de un grupo nuevo

select persona.id, persona_mail.mail, carrera.nombre as carrera
from persona
inner join persona_mail on persona.id = persona_mail.persona_id
inner join persona_interes on persona.id = persona_interes.persona_id
inner join carrera on carrera.id = persona_interes.carrera_id
inner join grupo on grupo.carrera_id = carrera.id
where grupo.nuevo = 1 and 
      persona.filial_id = 3 and 
      grupo.filial_id = 3

------------------------------------------------------------------------------------------
*/