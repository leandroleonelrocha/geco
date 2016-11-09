<?php

namespace App\Entities;

class ExamenPermisos extends Entity
{
    protected $table = 'examen_permisos';
    protected $primaryKey = 'nro_acta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nro_acta', 'matricula_id', 'filial_id'];

   

    public function Matricula(){
        return $this->belongsTo(Matricula::getClass());
    }

}

