<?php

namespace App\Http\Repositories;
use App\Entities\User;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class UserRepo extends BaseRepo {

    public function getModel()
    {
        return new User();
    }

    public function Delete($id = null)
    {
        $qry = $this->model->find($id)->delete();
    }


}