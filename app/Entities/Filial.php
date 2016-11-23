<?php
namespace App\Entities;

class Filial extends Entity {

    protected  $table= 'filial';
  //  protected $primaryKey= 'id_filial';

    protected $fillable   = ['cadena_id', 'nombre', 'direccion', 'localidad', 'director_id','codigo_postal', 'mail'];
    
    // Relaciones
    public function Cadena(){
        return $this->belongsTo(Cadena::getClass());
    }

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

    public function Mailing(){
        return $this->belongsTo(Mailing::getClass());
    }

    public function MatriculaPermisos(){
        return $this->hasMany(MatriculaPermisos::getClass());
    }

}