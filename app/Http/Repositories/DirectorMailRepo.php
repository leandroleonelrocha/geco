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
}