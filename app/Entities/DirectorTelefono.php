<?php

namespace App\Entities;

class DirectorTelefono extends Entity
{
    protected $table = 'director_telefono';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['director_id','telefono'];

    // Relaciones
    public function Director(){
        return $this->belongsTo(Director::getClass());
    }
}