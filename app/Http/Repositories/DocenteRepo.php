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
        return $this->model->where('activo', 1)->where('filial_id', $this->filial)->paginate(10);
    }

    public function check($tipo,$nro){
        return $this->model->where('tipo_documento_id', $tipo)->where('nro_documento', $nro)->update(['activo'=>1]);
    }

    public function disable($docente){
        $docente->activo = 0;
        return $docente->save();
    }
}