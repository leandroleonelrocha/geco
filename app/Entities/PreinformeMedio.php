<?php

namespace App\Entities;

class PreinformeMedio extends Entity
{
    protected $table = 'preinforme_medio';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['medio','lenguaje'];


    // Relaciones
    public function Preinforme(){
        return $this->hasMany(Preinforme::getClass());
    }

}