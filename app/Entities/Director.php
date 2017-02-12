<?php
namespace App\Entities;

class Director extends Entity {

    protected  $table= 'director';
 //	protected $primaryKey= 'id_director';

    protected $fillable   = ['tipo_documento_id', 'nro_documento', 'apellidos', 'nombres','mail',];

    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::getClass());
    }

    public function Filial(){
        return $this->hasMany(Filial::getClass());
    }

    //Funcion obtiene le nombre completo
    public function getFullNameAttribute(){

        return  $this->apellidos . ', ' . $this->nombres ;
    }

    public function DirectorTelefono(){
        return $this->hasMany(DirectorTelefono::getClass());
    }

    public function Cuenta(){
        return $this->hasOne(Cuenta::getClass(), 'entidad_id', 'id');
    }
}