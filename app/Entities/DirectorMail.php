<?php

namespace App\Entities;

class DirectorMail extends Entity
{
    protected $table = 'director_mail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['director_id','mail'];

    // Relaciones
    public function Director(){
        return $this->belongsTo(Director::getClass());
    }
}
