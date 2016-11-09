<?php
namespace App\Entities;

class Filial extends Entity {

    protected  $table= 'filial';
  //  protected $primaryKey= 'id_filial';

    protected $fillable   = ['nombre', 'direccion', 'localidad', 'director_id','codigo_postal', 'mail'];
    
    // Relaciones
    public function Director(){
        return $this->belongsTo(Director::getClass());
    }

   public function FilialTelefono(){
        return $this->hasMany(FilialTelefono::getClass());
    }

    public function Matricula(){
        return $this->hasMany(Matricula::getClass());
    }

    public function Pago(){
        return $this->hasMany(Pago::getClass());
    }

}