<?php

namespace App\Http\Repositories;
use App\Entities\PersonaMail;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PersonaMailRepo extends BaseRepo {

    public function getModel()
    {
        return new PersonaMail();
    }

    public function findMail($persona_id){
    	return PersonaMail::where('persona_id',$persona_id)->get();
    }

    public function editMail($id,$mail){
    	return PersonaMail::where('persona_id', $id)->update(array('mail' => $mail));
    }
}