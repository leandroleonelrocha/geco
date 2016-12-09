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


class CarreraController extends Controller
{
	protected $carreraRepo;

	public function __construct(CarreraRepo $carreraRepo)
	{
		$this->carreraRepo = $carreraRepo;
	}

	public function lista(){
		
		$carrera=$this->carreraRepo->listPaginate();
		return view('rol_filial.carreras.lista',compact('carrera'));
		
	}

	public function  nuevo(){
		
		return view('rol_filial.carreras.nuevo');
		
	}

	public function nuevo_post(CrearNuevaCarreraRequest $request){
	
		$this->carreraRepo->create($request->all());
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