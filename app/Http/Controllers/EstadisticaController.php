<?php

namespace App\Http\Controllers;
use Controllers;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PreinformeRepo;
use App\Entities\Persona;
use App\Entities\Preinforme;
use Illuminate\Http\Request;
use Session;
class EstadisticaController extends Controller
{
	public function __construct(PagoRepo $pagoRepo, PersonaRepo $personaRepo, PreinformeRepo $preinformeRepo)
	{
		$this->pagoRepo = $pagoRepo;
		$this->personaRepo = $personaRepo;
		$this->preinformeRepo = $preinformeRepo;

	}

	public function index(){
	  
		$generos = Preinforme::all();

	  return view('rol_filial.estadisticas.index', compact('generos'));
	}
	

	public function test()
	{
		$resultado = $this->preinformeRepo->estadisticas('2016-10-12 ', '2016-11-12 ')->get()->groupBy('como_encontro');
		return view('rol_filial.estadisticas.test');
	}



	public function estadistica_preinformes_ajax(Request $request)
	{	
		$array = explode("-", $request->get('fecha'));	
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';

		$data=[];
		$total = $this->personaRepo->countTotal();
		//Por genero
		$data['estadistica1'] = $this->personaRepo->getEstudioComputadora($inicio, $fin);
		$data['estadistica2'] = $this->personaRepo->getPoseeComputadora($inicio, $fin);

		
		$data=[];
		$data['parameter1'] = 'aklsdklñadls';
		$data['parameter2'] = 'papasa';
		
		
		return redirect()->route('filial.test')->with($data);

		/*
		if($request->get('selectvalue') == 'preinforme');
		{		
			$resultado = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');
			return view('rol_filial.estadisticas.test', compact('resultado'));
		}
		*/
		
		if($request->get('selectvalue') == 'inscripcion')
		{
			$generos = $this->personaRepo->getGenero($inicio, $fin);
			$posee_computadora = $this->personaRepo->getPoseeComputadora($inicio, $fin);
		
			$estudio_computadora = $this->personaRepo->getEstudioComputadora($inicio, $fin);
			return view('rol_filial.estadisticas.test', compact('posee_computadora'));
		}
		

	}

	/*
		for ($i = 1; $i <= 10; $i++) {

		    $data = [];
		    $data['persona_id'] = 3;
		    $data['asesor_id'] = 15;
		    $data['descripcion'] = "descripcion ".$i;
		    $data['medio'] = "volante";
		    $data['como_encontro'] = "volante";
		    $data['filial_id'] = 2;

		    	
			$preinformes = $this->preinformeRepo->create($data);
		
		}

	*/

	


}
