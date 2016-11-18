<?php

namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function allMorosos(){
        $filial = session('usuario')['entidad_id'];
        return DB::table('persona')
                   ->join('persona_mail',   'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('matricula',      'persona.id',   '=', 'matricula.persona_id')
                   ->join('pago',           'matricula.id', '=', 'pago.matricula_id')
                   ->select('persona.id as pe_id', 'persona.nombres', 'persona.apellidos', 'mail', 'pago.id as pa_id', 'pago.vencimiento', 'pago.recargo', 'pago.matricula_id', 'pago.nro_pago', 'matricula.ultimo_mail_enviado')
                   ->where('pago.vencimiento', '<', date('Y-m-d'))
                   ->where('pago.terminado', 0)
                   ->where('matricula.ultimo_mail_enviado', '<', date('Y-m-d'))
                   ->where('persona.filial_id', $filial)
                   ->where('matricula.filial_id', $filial)
                   ->get();
    }

    public function allInteresCursoGrupo(){
      $filial = session('usuario')['entidad_id'];
      return DB::table('persona')
                   ->join('persona_mail',    'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('persona_interes', 'persona.id',   '=', 'persona_interes.persona_id')
                   ->join('curso',           'curso.id',     '=', 'persona_interes.curso_id')
                   ->join('grupo',           'curso.id',     '=', 'grupo.curso_id')
                   ->select('persona.id', 'persona_mail.mail', 'curso.nombre as curso')
                   ->where('grupo.nuevo', 1)
                   ->where('persona.filial_id', $filial)
                   ->where('grupo.filial_id', $filial)
                   ->get();
    }

    public function allInteresCarreraGrupo(){
      $filial = session('usuario')['entidad_id'];
      return DB::table('persona')
                   ->join('persona_mail',    'persona.id',   '=', 'persona_mail.persona_id')
                   ->join('persona_interes', 'persona.id',   '=', 'persona_interes.persona_id')
                   ->join('carrera',         'carrera.id',   '=', 'persona_interes.carrera_id')
                   ->join('grupo',           'carrera.id',   '=', 'grupo.carrera_id')
                   ->select('persona.id', 'persona_mail.mail', 'carrera.nombre as carrera')
                   ->where('grupo.nuevo', 1)
                   ->where('persona.filial_id', $filial)
                   ->where('grupo.filial_id', $filial)
                   ->get();
    }
}

/*
Todos los morosos

select persona.id, persona_mail.mail, curso.nombre as curso
from persona
inner join persona_mail on persona.id = persona_mail.persona_id
inner join persona_interes on persona.id = persona_interes.persona_id
inner join curso on curso.id = persona_interes.curso_id
inner join grupo on grupo.curso_id = curso.id
where grupo.nuevo = 1

----------------------------------------------------------------------

Todas las personas que tienen de interes un curso de un grupo nuevo

select persona.id, persona_mail.mail, curso.nombre as curso
from persona
inner join persona_mail on persona.id = persona_mail.persona_id
inner join persona_interes on persona.id = persona_interes.persona_id
inner join curso on curso.id = persona_interes.curso_id
inner join grupo on grupo.curso_id = curso.id
where grupo.nuevo = 1

----------------------------------------------------------------------

Todas las personas que tienen de interes una carrera de un grupo nuevo

select persona.id, persona_mail.mail, carrera.nombre as carrera
from persona
inner join persona_mail on persona.id = persona_mail.persona_id
inner join persona_interes on persona.id = persona_interes.persona_id
inner join carrera on carrera.id = persona_interes.carrera_id
inner join grupo on grupo.carrera_id = carrera.id
where grupo.nuevo = 1

*/