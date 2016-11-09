<?php

namespace App\Http\Repositories;
use App\Entities\AsesorTelefono;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class AsesorTelefonoRepo extends BaseRepo {

    public function getModel()
    {
        return new AsesorTelefono();
    }

    public function findTelefono($asesor_id){
    	return AsesorTelefono::where('asesor_id',$asesor_id)->get();
    }

    public function editTelefono($id,$tel){
    	return AsesorTelefono::where('asesor_id', $id)->update(array('telefono' => $tel));
    }
}