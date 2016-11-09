<?php

namespace App\Http\Repositories;
use App\Entities\PersonaInteres;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PersonaInteresRepo extends BaseRepo {

    public function getModel()
    {
        return new PersonaInteres();
    }

    public function findPreinforme($preinforme_id){
    	return PersonaInteres::where('preinforme_id',$preinforme_id)->get();
    }
}