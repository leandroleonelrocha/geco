<?php

namespace App\Http\Repositories;
use App\Entities\PersonaTelefono;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PersonaTelefonoRepo extends BaseRepo {

    public function getModel()
    {
        return new PersonaTelefono();
    }

	public function findTelefono($persona_id){
    	return PersonaTelefono::where('persona_id',$persona_id)->get();
    }

    public function editTelefono($id,$tel){
    	return PersonaTelefono::where('persona_id', $id)->update(array('telefono' => $tel));
    }
}