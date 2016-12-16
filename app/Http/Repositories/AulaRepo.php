<?php

namespace App\Http\Repositories;
use App\Entities\Aula;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class AulaRepo extends BaseRepo {

    public function getModel()
    {
        return new Aula();
    }
}
