<?php
namespace App\Entities;

class Director extends Entity {

    protected  $table= 'director';
 //	protected $primaryKey= 'id_director';

    protected $fillable   = ['tipo_documento_id', 'nro_documento', 'apellidos', 'nombres',];

     public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::getClass());
    }


    //Funcion obtiene le nombre completo
    public function getFullNameAttribute(){

        return  $this->apellidos . ', ' . $this->nombres ;
    }

    public function DirectorMail(){
        return $this->hasMany(DirectorMail::getClass());
    }

    public function DirectorTelefono(){
        return $this->hasMany(DirectorTelefono::getClass());
    }
}