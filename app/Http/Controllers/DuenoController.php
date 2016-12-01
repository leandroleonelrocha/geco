<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\DuenoRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\AsesorRepo;
use App\Entities\Persona;
use DB;
class DuenoController extends Controller
{
	protected $examenRepo;
	protected $personaRepo;
	protected $duenoRepo;
	protected $filialRepo;
	protected $asesorRepo;

	public function __construct(ExamenRepo $examenRepo, PersonaRepo $personaRepo, DuenoRepo $duenoRepo, FilialRepo $filialRepo, AsesorRepo $asesorRepo ){
		$this->examenRepo   = $examenRepo;
		$this->personaRepo  = $personaRepo;
		$this->duenoRepo    = $duenoRepo;
		$this->filialRepo   = $filialRepo;
		$this->asesorRepo   = $asesorRepo;
	}
	
	public function index(){
		return view('rol_dueno.index');
	}

	public function estadisticas()
	{
		$data['total_persona'] = $this->personaRepo->all()->count();
		$data['total_filial']  = $this->filialRepo->all()->count();
		$data['total_asesor']  = $this->asesorRepo->all()->count();
		
		
		return view('rol_dueno.estadisticas.index')->with($data);	
	}

	public function detalles(Request $request){



		$array = explode("-", $request->get('fecha'));	
		$inicio = date("Y-m-d", strtotime($array[0])).' 00:00:00.000000';
		$fin = date("Y-m-d", strtotime($array[1])).' 00:00:00.000000';
		$tipo = $request->selectvalue;
		

		switch ($tipo) {

			case 'inscripcion':
			return $this->estadisticasDuenoInscripcion($inicio, $fin); break;

			case 'preinforme':
			return $this->estadisticasDuenoPreinforme($inicio, $fin); break;

			case 'recaudacion':
			return $this->estadisticasDuenoRecaudacion($inicio, $fin); break;

			case 'morosidad':
			return $this->estadisticasDuenoMorisidad($inicio, $fin); break;

			case 'examen':
			return $this->estadisticasDuenoExamen($inicio, $fin); break;
		}

	}



	public function estadisticasDuenoInscripcion($inicio, $fin)
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
				
			return view('rol_dueno.estadisticas.index',compact('total', 'inscripcion', 'genero'));
	}


	public function estadisticasDuenoPreinforme($inicio, $fin){

		$preinforme = $this->duenoRepo->preInformes($inicio, $fin)->get()->groupBy('como_encontro');
	
		return view('rol_dueno.estadisticas.index', compact('preinforme'));	
	}

	public function estadisticasDuenoRecaudacion($inicio, $fin){

		return 'recaudacion';
	}


	public function estadisticasDuenoMorisidad($inicio, $fin){

		return 'morosidad';
	}

	public function estadisticasDuenoExamen($inicio, $fin){
			$examenes = $this->examenRepo->allExamenFilialMatricula()->groupBy('nro_acta');
			foreach ($examenes as $key => $value) {
				dd($key);
			}
	}


}