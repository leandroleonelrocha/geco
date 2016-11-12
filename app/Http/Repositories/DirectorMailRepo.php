<?php

namespace App\Http\Repositories;
use App\Entities\DirectorMail;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class DirectorMailRepo extends BaseRepo {

    public function getModel()
    {
        return new DirectorMail();
    }

	public function findMail($director_id){
    	return DirectorMail::where('director_id',$director_id)->get();
    }
}