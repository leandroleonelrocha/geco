<?php

namespace App\Http\Repositories;
use App\Entities\Clase;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class ClaseRepo extends BaseRepo {

    public function getModel()
    {
        return new Clase();
    }

    


}