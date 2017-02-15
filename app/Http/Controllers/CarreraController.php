<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaCarreraRequest;
use App\Http\Requests\EditarCarreraRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\PaisRepo;


class CarreraController extends Controller
{
	protected $carreraRepo;

	public function __construct(CarreraRepo $carreraRepo, PaisRepo $paisRepo, FilialRepo $filialRepo)
	{
		$this->carreraRepo = $carreraRepo;
		$this->paisRepo = $paisRepo;
		$this->filialRepo = $filialRepo;
	}

	public function lista(){

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);
		$cadena 	= $this->filialRepo->filialCadena();
		
		$carreras=$this->carreraRepo->allCarreras($pais->lenguaje,$cadena->cadena_id);
		return view('rol_filial.carreras.lista',compact('carreras'));
	}

	public function  nuevo(){
		
		return view('rol_filial.carreras.nuevo');
		
	}

	public function nuevo_post(CrearNuevaCarreraRequest $request){
		
		$data = $request->all();

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);
		$cadena 	= $this->filialRepo->filialCadena();
		$data['cadena_id'] =$cadena->cadena_id;
		$data['lenguaje'] =$pais->lenguaje;

		$this->carreraRepo->create($data);
		return redirect()->route('filial.carreras')->with('msg_ok', 'Carrera creada correctamente');
	}

  	public function editar($id){
  	
		$carrera = $this->carreraRepo->find($id);
		return view('rol_filial.carreras.editar',compact('carrera'));
		
    }

    public function editar_post(EditarCarreraRequest $request){
    	
		$data = $request->all();
		$model = $this->carreraRepo->find($data['id']);
		if($this->carreraRepo->edit($model,$data))
		    return redirect()->route('filial.carreras')->with('msg_ok','La carrera ha sido modificada con éxito');
		else
		    return redirect()->route('filial.carreras')->with('msg_error','La carrera no ha podido ser modificada.');
		
    }

    public function borrar($id){
    	
		if($data=$this->carreraRepo->find($id))
		{
	     	$data->Delete();
         	return redirect()->back()->with('msg_ok', 'Carrera eliminada correctamente');
	        }
	    else
	        return redirect()->back()->with('msg_error','La carrera no ha podido ser eliminada.');
    }
}