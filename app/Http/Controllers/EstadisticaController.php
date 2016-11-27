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

	public function index(Request $request){

	 $persona = $this->personaRepo->getPersonasFilial()->count();
	 $asesores = $this->asesorFilialRepo->allAsesorFilial()->count();
     return view('rol_filial.estadisticas.index', compact('persona','asesores'));
	
	}
	

	

	public function detalles(Request $request)
	{	
		$persona = $this->personaRepo->getPersonasFilial()->count();
	 	$asesores = $this->asesorFilialRepo->allAsesorFilial()->count();
		
		$array = explode("-", $request->get('fecha'));	
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';

		
			if($request->selectvalue == 'inscripcion')
			{		
				return $this->estadisticasFilialInscripcion($inicio, $fin);
			}

			if($request->selectvalue == 'preinforme')
			{		
				$preinforme = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');
				return view('rol_filial.estadisticas.detalles', compact('preinforme'));
			}

			
			if($request->selectvalue == 'recaudacion')
			{
				return $this->estadisticasFilialRecaudacion();
			}

			if($request->selectvalue == 'morosidad')
			{
				return $this->estadisticasFilialMorosidad();
			}


		

	}


	public function estadisticasFilialInscripcion($inicio, $fin){

		
		$persona = $this->personaRepo->getPersonasFilial()->count();
	 	$asesores = $this->asesorFilialRepo->allAsesorFilial()->count();

		$labels =['posee_computadora', 'estudio_computacion', 'disponibilidad_manana', 'disponibilidad_tarde', 'disponibilidad_noche', 'disponibilidad_sabados'];	
		$nombre=['Posee PC', 'Estudio PC',  'Manana', 'Tarde', 'Noche', 'Sabados'];

		$inscripcion=[];
			
			for($i =0; $i<count($labels); $i++ ){
				$data['label'] = $nombre[$i];
				$data['si']    = $this->personaRepo->estadisticasPersonas($labels[$i], 1, $inicio, $fin);
				$data['no']	   = $this->personaRepo->estadisticasPersonas($labels[$i], 1, $inicio, $fin);

				array_push($inscripcion, $data);
			}

			$total = $this->personaRepo->countTotal($inicio, $fin);
			$genero = $this->personaRepo->getGenero($inicio, $fin);
			$nivel = $this->personaRepo->estadisticasNivelEstudios($inicio, $fin);

			return view('rol_filial.estadisticas.index',compact('inscripcion', 'genero', 'total', 'persona', 'asesores','nivel'));
		

	}


	public function estadisticasFilialMorosidad()
	{
		return 'morosidad';
	}


	public function estadisticasFilialRecaudacion(){
		return 'recaudacion';
	}

	

	


}
