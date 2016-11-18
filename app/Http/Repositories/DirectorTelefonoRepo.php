<?php

namespace App\Http\Repositories;
use App\Entities\DirectorTelefono;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class DirectorTelefonoRepo extends BaseRepo {

    public function getModel()
    {
        return new DirectorTelefono();
    }

	public function findTelefono($director_id){
    	return $this->model->where('director_id',$director_id)->get();
    }

    public function editTelefono($id,$tel){
        return $this->model->where('director_id', $id)->update(array('telefono' => $tel));
    }
}