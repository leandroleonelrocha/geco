<?php

namespace App\Http\Repositories;
use App\Entities\Curso;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class CursoRepo extends BaseRepo {

    public function getModel()
    {
        return new Curso();
    }
}