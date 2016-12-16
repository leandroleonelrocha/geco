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
		return view('rol_filial.grupos.asignacionAula.nuevo');	
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
}