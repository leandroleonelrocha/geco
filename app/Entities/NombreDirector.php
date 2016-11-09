<?php

namespace App\Entities;


class NombreDirector extends Entity
{
    protected $table = 'director';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombres'];

    public function Filial()
    {
        return $this->belongsToMany(Filial::getClass());
    }
}