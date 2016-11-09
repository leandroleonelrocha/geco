<?php

namespace App\Http\Repositories;
use App\Entities\FilialTelefono;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class FilialTelefonoRepo extends BaseRepo {

    public function getModel()
    {
        return new FilialTelefono();
    }

    public function findTelefono($filial_id){
    	return FilialTelefono::where('filial_id',$filial_id)->get();
    }

    public function editTelefono($id,$tel){
        return FilialTelefono::where('filial_id', $id)->update(array('telefono' => $tel));
    }
}