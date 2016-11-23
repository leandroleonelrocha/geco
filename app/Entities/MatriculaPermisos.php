<?php

namespace App\Entities;

class MatriculaPermisos extends Entity
{
    protected $table = 'matricula_permisos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['matricula_id','filial_id', 'confirmar'];

    // Relaciones
    public function Matricula(){
        return $this->belongsTo(Matricula::getClass());
    }

    public function Filial(){
        return $this->belongsTo(Filial::getClass());
    }
}
