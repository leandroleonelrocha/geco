<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\DuenoRepo;
use App\Entities\Persona;
use DB;
class DuenoController extends Controller
{
	protected $examenRepo;
	protected $personaRepo;
	protected $duenoRepo;

	public function __construct(ExamenRepo $examenRepo, PersonaRepo $personaRepo, DuenoRepo $duenoRepo){
		$this->examenRepo = $examenRepo;
		$this->personaRepo = $personaRepo;
		$this->duenoRepo = $duenoRepo;
	}
	
	public function index(){
		return view('rol_dueno.index');
	}

	public function estadisticas()
	{
		

		return view('rol_dueno.estadisticas.index');	
	}

	public function detalles(Request $request){
		$array = explode("-", $request->get('fecha'));	
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';
		

		if($request->selectvalue == 'inscripcion')
		{		
			$labels=['estudio_computacion', 'posee_computadora', 'disponibilidad_manana', 'disponibilidad_tarde', 'disponibilidad_noche', 'disponibilidad_sabados'];
			$inscripcion =[];
			$total = $this->personaRepo->all()->count();

			for($i =0; $i<count($labels); $i++ ){
				$data['label'] = $labels[$i];
				$data['si'] = $this->duenoRepo->poseeComputadora($labels[$i], 1, $inicio, $fin);
				$data['no'] = $this->duenoRepo->poseeComputadora($labels[$i], 0, $inicio, $fin);
				array_push($inscripcion, $data);
			}

			$genero = $this->duenoRepo->getGenero($inicio,$fin);
			
			
			return view('rol_dueno.estadisticas.detalles',compact('total', 'inscripcion', 'genero'));
	
		}

		if($request->selectvalue == 'preinforme')
		{		
			$preinforme = $this->duenoRepo->preInformes($inicio, $fin)->get()->groupBy('como_encontro');
			
			return view('rol_dueno.estadisticas.detalles', compact('preinforme'));
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
			$examenes = $this->examenRepo->allExamenFilialMatricula()->groupBy('nro_acta');
			foreach ($examenes as $key => $value) {
				# code...
				dd($key);
			}

		}

	}

}