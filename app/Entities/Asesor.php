<?php

namespace App\Entities;

class Asesor extends Entity
{
    protected $table = 'asesor';
  //  protected $primarykey   = 'id_asesor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_documento_id','nro_documento','apellidos','nombres','direccion','localidad','activo'];

    public function getFullNameAttribute()
    {
        return  $this->apellidos . ', ' . $this->nombres ;
    }

    // Relaciones
    public function Preinforme(){
        return $this->hasMany(Preinforme::getClass());
    }

    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::getClass());
    }

    public function AsesorMail(){
        return $this->hasMany(AsesorMail::getClass());
    }

    public function AsesorTelefono(){
        return $this->hasMany(AsesorTelefono::getClass());
    }

    public function AsesorFilial(){
        return $this->hasMany(AsesorFilial::getClass());
    }

}
