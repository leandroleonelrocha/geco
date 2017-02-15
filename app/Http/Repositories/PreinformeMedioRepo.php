<?php

namespace App\Http\Repositories;
use App\Entities\PreinformeMedio;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class PreinformeMedioRepo extends BaseRepo {

    public function getModel()
    {
        return new PreinformeMedio();
    }
}