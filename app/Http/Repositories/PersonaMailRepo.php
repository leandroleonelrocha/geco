<?php

namespace App\Http\Repositories;
use App\Entities\PersonaMail;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

class PersonaMailRepo extends BaseRepo {

    public function getModel()
    {
        return new PersonaMail();
    }

    public function findMail($persona_id){
    	return $this->model->where('persona_id',$persona_id)->get();
    }

    public function editMail($id,$mail){
    	return $this->model->where('persona_id', $id)->update(array('mail' => $mail));
    }

    public function allMailPersonaFilial(){
        $filial = session('usuario')['entidad_id'];
        return DB::table('persona_mail')
                   ->join('persona', 'persona_mail.persona_id', '=', 'persona.id')
                   ->select('persona_id', 'mail')
                   ->where('filial_id', $filial)
                   ->get();
    }
}