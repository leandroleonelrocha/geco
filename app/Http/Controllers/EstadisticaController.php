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
    protected  $totalPersonas;
    protected  $totalAsesores;
    protected  $data;

	public function __construct(PagoRepo $pagoRepo, PersonaRepo $personaRepo, PreinformeRepo $preinformeRepo, ExamenRepo $examenRepo, AsesorFilialRepo $asesorFilialRepo)
	{
		$this->pagoRepo         = $pagoRepo;
		$this->personaRepo      = $personaRepo;
		$this->preinformeRepo   = $preinformeRepo;
		$this->examenRepo       = $examenRepo;
		$this->asesorFilialRepo = $asesorFilialRepo;
        $this->data['totalPersonas']    = $this->total_personas();
        $this->data['totalAsesores']    = $this->total_asesores();

	}

	public function total_personas(){
        return $this->personaRepo->getPersonasFilial()->count();
    }

    public function total_asesores(){
        return $this->asesorFilialRepo->allAsesorFilial()->count();
    }

<<<<<<< HEAD
		$persona = $this->personaRepo->getPersonasFilial()->count();
		$asesores = $this->asesorFilialRepo->allAsesorFilial()->count();
		return view('rol_filial.estadisticas.index', compact('persona','asesores'));
	}
	
=======
	public function index(){

    return view('rol_filial.estadisticas.index')->with($this->data);
	
	}

	public function count_personas(){
        return $this->personaRepo->getPersonasFilial()->count();
    }
	

>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
	public function detalles(Request $request)
	{	
		$tipo = $request->selectvalue;

<<<<<<< HEAD
		if($request->selectvalue == 'inscripcion')
		{		
			return $this->estadisticasFilialInscripcion($inicio, $fin);
		}

		if($request->selectvalue == 'preinforme')
		{		
			$preinforme = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');
			return view('rol_filial.estadisticas.detalles', compact('preinforme'));
		}
=======
		$array = explode("-", $request->get('fecha'));
        $inicio = helpersfuncionFecha($array[0]);
        $fin =  helpersfuncionFecha($array[1]);

		switch ($tipo) {

		    case 'inscripcion':
		        return $this->estadisticasFilialInscripcion($inicio, $fin); break;

		    case 'preinforme':
		       return $this->estadisticasFilialPreinforme($inicio, $fin); break;
		       
		    case 'morosidad':
		       return $this->estadisticasFilialRecaudacion($inicio, $fin); break;
		    
		    case 'morosidad':
		    	return $this->estadisticasFilialMorosidad($inicio, $fin); break;  

		    case 'examen':
		    	return $this->estadisticasFilialExamen($inicio, $fin); break;	
		}
		
		
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9

		
		if($request->selectvalue == 'recaudacion')
		{
			return $this->estadisticasFilialRecaudacion();
		}

		if($request->selectvalue == 'morosidad')
		{
			return $this->estadisticasFilialMorosidad();
		}
	}

<<<<<<< HEAD
=======
	/*
	Estadisticas relacionadas a las inscripciones
	*/

>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
	public function estadisticasFilialInscripcion($inicio, $fin){

        $secion = 'inscripcion';
		$totalPersonas = $this->data['totalPersonas'];
	 	$totalAsesores = $this->data['totalAsesores'];
        $labels  = helperslabelsEstadisticas();
        $nombres = helpersnombresEstadisticas();
        $disponibilidad=[];

<<<<<<< HEAD
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
=======
			for($i =0; $i<count($labels); $i++ ){
				$data['label'] = $nombres[$i];
				$data['si']    = $this->personaRepo->estadisticasPersonas($labels[$i], 1, $inicio, $fin);
				$data['no']	   = $this->personaRepo->estadisticasPersonas($labels[$i], 1, $inicio, $fin);

				array_push($disponibilidad, $data);
			}

			$totalPersonasFilial = $this->personaRepo->countTotal($inicio, $fin);
			$genero = $this->personaRepo->getGenero($inicio, $fin);
			$nivelEstudios = $this->personaRepo->estadisticasNivelEstudios($inicio, $fin);

			return view('rol_filial.estadisticas.index',compact('secion','disponibilidad', 'genero', 'totalPersonasFilial', 'nivelEstudios', 'totalPersonas', 'totalAsesores'));
		
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9

		return view('rol_filial.estadisticas.index',compact('inscripcion', 'genero', 'total', 'persona', 'asesores','nivel'));
	}

<<<<<<< HEAD
	public function estadisticasFilialMorosidad()
=======
	/*
	Estadisticas relacionadas a los pre informes
	*/

	public function estadisticasFilialPreinforme($inicio, $fin){

        $this->data['secion'] = 'preinforme';
		$this->data['preinforme'] = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');

		return view('rol_filial.estadisticas.index')->with($this->data);
	}

	/*
	Estadisticas relacionadas a la recaudacion
	*/

	public function estadisticasFilialRecaudacion($inicio, $fin){
		return 'recaudacion';
	}

	/*
	Estadisticas relacionadas a la morosidad
	*/

	public function estadisticasFilialMorosidad($inicio, $fin)
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
	{
		return 'morosidad';
	}

	public function estadisticasFilialExamen($inicio, $fin)
	{
       $examenes= $this->examenRepo->allExamenFilialMatricula();


		return 'examen';
	}

<<<<<<< HEAD
=======





	


>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
}
