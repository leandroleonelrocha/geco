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

	public function index(){

    return view('rol_filial.estadisticas.index')->with($this->data);
	
	}

	public function count_personas(){
        return $this->personaRepo->getPersonasFilial()->count();
    }
	

	public function detalles(Request $request)
	{	
		$tipo = $request->selectvalue;

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
		
		

		

	}

	/*
	Estadisticas relacionadas a las inscripciones
	*/

	public function estadisticasFilialInscripcion($inicio, $fin){

        $secion = 'inscripcion';
		$totalPersonas = $this->data['totalPersonas'];
	 	$totalAsesores = $this->data['totalAsesores'];
        $labels  = helperslabelsEstadisticas();
        $nombres = helpersnombresEstadisticas();
        $disponibilidad=[];

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
		

	}

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
	{
		return 'morosidad';
	}

	public function estadisticasFilialExamen($inicio, $fin)
	{
		return 'examen';
	}






	


}
