<?php
namespace App\Http\Controllers;
use Controllers;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PreinformeRepo;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\FilialRepo;
use App\Entities\Asesor;
use App\Entities\Persona;
use App\Entities\Preinforme;
use Illuminate\Http\Request;
use Session;
class EstadisticaController extends Controller
{
    protected  $totalPersonas;
    protected  $totalAsesores;
    protected  $data;
	public function __construct(FilialRepo $filialRepo, PagoRepo $pagoRepo, PersonaRepo $personaRepo, PreinformeRepo $preinformeRepo, ExamenRepo $examenRepo,AsesorRepo $asesorRepo)
	{
		$this->pagoRepo        			= $pagoRepo;
		$this->personaRepo      		= $personaRepo;
		$this->preinformeRepo  			= $preinformeRepo;
		$this->examenRepo      			= $examenRepo;
		$this->asesorRepo     			= $asesorRepo;
		$this->filialRepo 				= $filialRepo;
       // $this->data['totalPersonas']    = $this->total_personas();
       // $this->data['totalAsesores']    = $this->total_asesores();
	}
	public function total_personas(){
		
        return $this->personaRepo->getPersonasFilial()->total();
    }
    public function total_asesores(){
        return $this->asesorRepo->allAsesores()->count();
    }

    public function lista(){

    	return 'lista';
    }

	public function caja_diaria(){

    	//return view('rol_filial.estadisticas.index')->with($this->data);
    	$hoy = getdate();
		dd(date("Y/m/d"));
	
    	return view('rol_filial.estadisticas.caja_diaria');
	
	}

	public function preinforme(){
		return view('rol_filial.estadisticas.preinforme');
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
		       
		    case 'recaudacion':
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
				$data['no']	   = $this->personaRepo->estadisticasPersonas($labels[$i], 0, $inicio, $fin);
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
        $this->data['secion']	  = 'preinforme';
		$this->data['preinforme'] = $this->preinformeRepo->estadisticas($inicio, $fin)->get()->groupBy('como_encontro');
		return view('rol_filial.estadisticas.index')->with($this->data);
	}
	/*
	Estadisticas relacionadas a la recaudacion
	*/
	public function estadisticasFilialRecaudacion($inicio, $fin){
		$this->data['secion']				  = 'recaudacion';
		$this->data['total_recaudacion']	  = $this->filialRepo->montoTotalRecaudacion($inicio, $fin);
		$this->data['recaudacion'] 			  = $this->filialRepo->estadisticasRecaudacion($inicio, $fin);
		return view('rol_filial.estadisticas.index')->with($this->data);
	}
	/*
	Estadisticas relacionadas a la morosidad
	*/
	public function estadisticasFilialMorosidad($inicio, $fin)
	{
		$this->data['secion']	  		  = 'morosidad';
		$this->data['total_morosidad']	  = $this->filialRepo->montoTotalMorosidad($inicio, $fin);
		$this->data['morosidad'] = $this->filialRepo->estadisticasMorosidad($inicio, $fin);
		return view('rol_filial.estadisticas.index')->with($this->data);
	}
	public function estadisticasFilialExamen($inicio, $fin)
	{
		$this->data['secion'] 	= 'examen';	
    	$this->data['examenes']	= $this->filialRepo->estadisticasExamen($inicio, $fin);
		return view('rol_filial.estadisticas.index')->with($this->data);
	}



	
}
