<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\Aula;
use App\Http\Repositories\AulaRepo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaAulaRequest;
use App\Http\Requests\EditarAulaRequest;

class AulaController extends Controller
{
	protected $aulaRepo;

	public function __construct(AulaRepo $aulaRepo)
	{
		$this->aulaRepo = $aulaRepo;
	}

	public function lista(){

	}

	public function nuevo(){

		$aulas= $this->aulaRepo->allAulasPaginadas();
		return view('rol_filial.grupos.asignacionAula.nuevo',compact('aulas'));	
	}


	public function nuevo_post(CrearNuevaAulaRequest $request){
	 	$data = $request->all();
	 	$aula['filial_id'] 	= session('usuario')['entidad_id'];
		foreach ($data['nombre'] as $key) {
			$aula['nombre'] = $key;;
			$this->aulaRepo->create($aula);
		}
		return redirect()->back()->with('msg_ok', 'Aulas asignadas correctamente');
	}

	public function editar($id){

		$aula = $this->aulaRepo->find($id);
		return view('rol_filial.grupos.asignacionAula.editar',compact('aula'));

	}


    public function editar_post(EditarAulaRequest $request){
    	
		$data = $request->all();
		$model = $this->aulaRepo->find($data['id']);
		if($this->aulaRepo->edit($model,$data))
		    return redirect()->route('filial.asignacionAulas_nuevo')->with('msg_ok','El nombre de aula ha sido modificado con éxito');
		else
		    return redirect()->route('filial.asignacionAulas_editar')->with('msg_error','El nombre de aula  no ha podido ser modificada.');
		
    }
}