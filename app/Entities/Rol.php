<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Hash;

namespace App\Entities;


class Rol extends Entity{

    protected $table = 'rol';
    protected $fillable = ['rol'];

   
    //relaciones

    public function Cuenta()
    {
        return $this->belongsToMany(Cuenta::getClass());
    }

  

}