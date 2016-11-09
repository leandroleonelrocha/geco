<?php
namespace App\Http\Repositories;
use App\Entities\Docente;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
class DocenteRepo extends BaseRepo {
    public function getModel()
    {
        return new Docente();
    }
    
    public function allEneable(){
        $filial = session('usuario')['entidad_id'];
        return Docente::where('activo', 1)->where('filial_id', $filial)->get();
    }

    public function check($tipo,$nro){
        return Docente::where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($docente){
        $docente->activo = 0;
        return $docente->save();
    }
}