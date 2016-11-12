<?php

namespace App\Http\Controllers;
use Controllers;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PreinformeRepo;
use App\Entities\Persona;
use App\Entities\Preinforme;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
	public function __construct(PagoRepo $pagoRepo, PersonaRepo $personaRepo, PreinformeRepo $preinformeRepo)
	{
		$this->pagoRepo = $pagoRepo;
		$this->personaRepo = $personaRepo;
		$this->preinformeRepo = $preinformeRepo;

	}

	public function index(){
	  
	  $pagos = $this->pagoRepo->all();
	  $months = array("Personas inscriptas", "Recaudacion", "Marzo", "Abril", "Mayo", "Junio");


	  
	  return view('rol_filial.estadisticas.index', compact('pagos', 'months'));
	}
	//["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
	//Estadisticas de pago
	//



	public function procesarAjax(Request $request)
	{


		$array = explode("-", $request->get('fecha'));
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';

		//$personas = $this->personaRepo->qryWhereDate($inicio, $fin)->count();
		//return $this->model->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->groupBy('como_encontro')->get();
		//$preinformes = $this->preinformeRepo->qryWhereDate($inicio, $fin);
		$preinformes = Preinforme::all()->groupBy('como_encontro');
		
		foreach($preinformes as $preinforme => $a)
		{
				
			dd($preinforme . $a->count());
		}	
	
		return response()->json($personas, 200);
	
		 	



	}


}
