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

	// public function nuevo_post(Request $request){
	// 	$this->aulaRepo->create($request->all());
	// 	return redirect()->route('filial.asignacionAula')->with('msg_ok', 'a');
	// }
}