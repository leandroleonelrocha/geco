<?php

namespace App\Http\Repositories;
use App\Entities\PreinformeComoEncontro;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PreinformeComoEncontroRepo extends BaseRepo {

    public function getModel()
    {
        return new PreinformeComoEncontro();
    }
}