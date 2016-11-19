<?php

namespace App\Http\Repositories;
use App\Entities\Cadena;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class CadenaRepo extends BaseRepo {

    public function getModel()
    {
        return new Cadena();
    }
}

         
           
            
           