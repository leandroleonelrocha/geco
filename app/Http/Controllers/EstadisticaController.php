<?php

namespace App\Http\Controllers;
use Controllers;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PreinformeRepo;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\AsesorFilialRepo;;
use App\Entities\Persona;
use App\Entities\Preinforme;
use Illuminate\Http\Request;
use Session;
class EstadisticaController extends Controller
{
	public function __construct(PagoRepo $pagoRepo, PersonaRepo $personaRepo, PreinformeRepo $preinformeRepo, ExamenRepo $examenRepo, AsesorFilialRepo $asesorFilialRepo)
	{
		$this->pagoRepo = $pagoRepo;
		$this->personaRepo = $personaRepo;
		$this->preinformeRepo = $preinformeRepo;
		$this->examenRepo = $examenRepo;
		$this->asesorFilialRepo = $asesorFilialRepo;

	}

	public function index(){

	 $persona = $this->personaRepo->getPersonasFilial()->count();
	 $asesores = $this->asesorFilialRepo->allAsesorFilial()->count();
	
		
	  return view('rol_filial.estadisticas.index', compact('persona','asesores'));
	}
	

	

	public function detalles(Request $request)
	{
		$array = explode("-", $request->get('fecha'));	
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';

		

		if($request->selectvalue == 'inscripcion')
		{		
			$data=[];
			$total = $this->personaRepo->countTotal();
			$data['estadistica1'] = $this->personaRepo->getEstudioComputadora($inicio, $fin);
			$data['estadistica2'] = $this->personaRepo->getPoseeComputadora($inicio, $fin);
			$data['estadistica3'] = $this->personaRepo->disponibilidadManana($inicio, $fin);
			$data['estadistica4'] = $this->personaRepo->disponibilidadTarde($inicio, $fin);
			$data['estadistica5'] = $this->personaRepo->disponibilidadNoche($inicio, $fin);
			$data['estadistica6'] = $this->personaRepo->disponibilidadSabado($inicio, $fin);
			$genero = $this->personaRepo->getGenero($inicio, $fin);
			return view('rol_filial.estadisticas.detalles',compact('data', 'genero', 'total'));
		}

		if($request->selectvalue == 'preinforme')
		{		
			$preinforme = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');
			return view('rol_filial.estadisticas.detalles', compact('preinforme'));
		}

		if($request->selectvalue == 'recaudacion')
		{
			return 'recaudacion';
		}

		if($request->selectvalue == 'morosidad')
		{
			return 'morosidad';
		}


		if($request->selectvalue == 'examen')
		{
			$examenes = $this->examenRepo->allExamenFilialMatricula();
			

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
