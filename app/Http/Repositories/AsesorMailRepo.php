<?php

namespace App\Http\Repositories;
use App\Entities\AsesorMail;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class AsesorMailRepo extends BaseRepo {

    public function getModel()
    {
        return new AsesorMail();
    }

    public function findMail($asesor_id){
    	return AsesorMail::where('asesor_id',$asesor_id)->get();
    }

    public function editMail($id,$mail){
    	return AsesorMail::where('asesor_id', $id)->update(array('mail' => $mail));
    }
}