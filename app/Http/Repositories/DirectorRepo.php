<?php

namespace App\Http\Repositories;
use App\Entities\Director;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class DirectorRepo extends BaseRepo {

    public function getModel(){
        return new Director();
    }

    public function allEneable(){
        return $this->model->where('activo', 1)->get();
    }

    public function check($mail){
    	return $this->model->where('mail', $mail)->update(['activo'=>1]);
    }

    public function disable($director){
    	$director->activo = 0;
    	return $director->save();
    }

    public function existeMail($mail){
        return $this->model->where('mail', $mail)->first();
    }
}