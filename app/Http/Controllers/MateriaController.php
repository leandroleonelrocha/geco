<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaMateriaRequest;
use App\Http\Requests\EditarMateriaRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\MateriaRepo;


class MateriaController extends Controller
{
	protected $materiaRepo;

	public function __construct(MateriaRepo $materiaRepo, CarreraRepo $carreraRepo)
	{
		$this->materiaRepo = $materiaRepo;
		$this->carreraRepo = $carreraRepo;
	}

	public function lista(){
		$materia=$this->materiaRepo->listPaginate();
		return view('rol_filial.materias.lista',compact('materia'));
	}

	public function nuevo(){
		$carreras = $this->carreraRepo->lists('nombre','id');
		return view('rol_filial.materias.nuevo', compact('carreras'));	
	}

	public function nuevo_post(CrearNuevaMateriaRequest $request){
		$this->materiaRepo->create($request->all());
		return redirect()->route('filial.materias')->with('msg_ok', 'Materia creada correctamente');
	}

 	public function editar($id){
		$carreras = $this->carreraRepo->lists('nombre','id');
		$materia = $this->materiaRepo->find($id);
		return view('rol_filial.materias.editar',compact('materia','carreras'));	
    }

    public function editar_post(EditarMateriaRequest $request){
		$data = $request->all();
		$model = $this->materiaRepo->find($data['id']);

		if($this->materiaRepo->edit($model,$data))	

        	return redirect()->route('filial.materias')->with('msg_ok','La materia ha sido modificada con éxito');
		else
		    return redirect()->route('filial.materias')->with('msg_error','La materia no ha podido ser modificada.');	
    }

    public function borrar($id){
		if($data=$this->materiaRepo->find($id))
		{
	    	$data->Delete();
	        return redirect()->back()->with('msg_ok', 'Materia eliminada correctamente');
	        }
	    else
	       return redirect()->back()->with('msg_error','La materia no ha podido ser eliminada.');	
    }
}