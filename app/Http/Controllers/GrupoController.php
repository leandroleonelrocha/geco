<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\MateriaRepo;
use App\Http\Repositories\DocenteRepo;
use App\Http\Repositories\GrupoRepo;
use App\Http\Repositories\ClaseRepo;
use App\Http\Repositories\ClaseMatriculaRepo;
use App\Entities\Clase;
use App\Entities\GrupoMatricula;
use App\Entities\ClaseMatricula;
use App\Entities\GrupoHorario;
use App\Http\Requests\CrearNuevoGrupoRequest;


class GrupoController extends Controller
{
	protected $cursoRepo;
	protected $carreraRepo;
	protected $materiaRepo;
	protected $docenteRepo;
	protected $grupoRepo;
	protected $claseRepo;
	protected $claseMatriculaRepo;

	public function __construct(CursoRepo $cursoRepo, CarreraRepo $carreraRepo, MateriaRepo $materiaRepo, DocenteRepo $docenteRepo, GrupoRepo $grupoRepo, ClaseRepo $claseRepo , ClaseMatriculaRepo $claseMatriculaRepo)
	{
		$this->cursoRepo = $cursoRepo;
		$this->carreraRepo = $carreraRepo;
		$this->materiaRepo = $materiaRepo;
		$this->docenteRepo = $docenteRepo;
		$this->grupoRepo = $grupoRepo;
		$this->claseRepo = $claseRepo;
		$this->claseMatriculaRepo = $claseMatriculaRepo;
		
	}	

	public function index(){

		$grupos = $this->grupoRepo->allEnable();
		return view('rol_filial.grupos.index', compact('grupos'));
	}

	public function nuevo(){
		$carreras = $this->carreraRepo->all();
        $cursos  = $this->cursoRepo->all();
		$materias =  $this->materiaRepo->lists('nombre','id');
		$docentes = $this->docenteRepo->all()->lists('apellidos', 'id');
		return view('rol_filial.grupos.form', compact('cursos', 'carreras', 'materias','docentes'));
	}

	public function edit($id){
		$model = $this->grupoRepo->find($id);
		$carreras = $this->carreraRepo->all();
        $cursos  = $this->cursoRepo->all();
		$materias =  $this->materiaRepo->lists('nombre','id');
		$docentes = $this->docenteRepo->all()->lists('apellidos', 'id');
		return view('rol_filial.grupos.form', compact('model', 'cursos', 'carreras', 'materias', 'docentes'));
	}


	public function postAdd(CrearNuevoGrupoRequest $request){
        $data = $request->all();
        $array = explode("-", $request->get('fecha'));
		$carrearas_cursos = explode(';',$request->carreras_cursos);
            if ($carrearas_cursos[0] == 'carrera')
                $data['carrera_id']    =   $carrearas_cursos[1];
            elseif ($carrearas_cursos[0] == 'curso')
                $data['curso_id']      =   $carrearas_cursos[1];	

		$data['fecha_inicio'] = date("Y-m-d", strtotime($array[0]));
		$data['fecha_fin'] = date("Y-m-d", strtotime($array[1]));
		$data['filial_id'] = session('usuario')['entidad_id'];
		
		// Creación del grupo
		$this->grupoRepo->create($data);
        $grupo = $this->grupoRepo->all()->last();
        $longitud = count($request->dia);
        for($i=0;$i<$longitud;$i++) {
            $data['dia'] = $request->dia[$i];
            $data['horario_desde'] = $request->horario_desde[$i];
            $data['horario_hasta'] = $request->horario_hasta[$i];
            $grupo->GrupoHorario()->create($data);
        }

		$grupo_dias =[];
		$dias_horas = [];
        $ultimo = $this->grupoRepo->all()->last();
        foreach ($ultimo->GrupoHorario as $value ) {
			array_push($grupo_dias, $value->dia);
		}

		foreach ($ultimo->GrupoHorario as $value ) {
		  	$d['horario_desde'] = $value->horario_desde;
		  	$d['horario_hasta'] = $value->horario_hasta;
			array_push($dias_horas, $d);
		}

		$fecha1 = date("Y-m-d", strtotime($ultimo->fecha_inicio));
		$fecha2 = date("Y-m-d", strtotime($ultimo->fecha_fin));
		
		for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
			$contador = 0;
			$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
			$fecha = $dias[date('N', strtotime($i))];

			if (in_array($fecha, $grupo_dias)) {
			    // Cargo fecha
			    if ($i >= date('Y-m-d'))
			    	$data['clase_estado_id'] = 1;
			    else
			    	$data['clase_estado_id'] = 2;

			    $data['grupo_id'] 		 = $ultimo->id;
			    $data['fecha'] 			 = $i;
			    $data['docente_id'] 	 = $ultimo->docente_id;
			    $data['descripcion'] 	 = '(La clase no tiene descripción)';
			    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
			    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
			    $data['enviado'] 	 	 = 0;

			    $this->claseRepo->create($data);
			}
			$contador ++;
		}
        return redirect()->route('grupos.index')->with('msg_ok', 'Grupo creado correctamente');
    }

	public function postEdit($id, CrearNuevoGrupoRequest $request){
		$model 					= $this->grupoRepo->find($id);
		$data 					= $request->all();
		$array 					= explode("-", $request->get('fecha'));
		$data['fecha_inicio'] 	= date("Y-m-d", strtotime($array[0]));
		$data['fecha_fin'] 		= date("Y-m-d", strtotime($array[1]));
		$grupo_dias 			= [];
		$dias_horas 			= [];
		// $inicio 				= date("Y-m-d", strtotime($model->fecha_inicio));
		$fin 					= date("Y-m-d", strtotime($model->fecha_fin));
		$clases 				= $this->claseRepo->findAllClaseGrupo($model->id);
        
		// Validar que Fecha FIN no sea anterior a una clase finalizada (ESTADO = 3)
		foreach ($clases as $clase) {
			if ($data['fecha_fin'] < $clase->fecha && $clase->clase_estado_id == 3) {
				return redirect()->back()->with('msg_error', 'Hay clases finalizadas posterior a la fecha de FIN ingresada, ingresa una fecha de fin posterior.');
			}
		}

        foreach ($model->GrupoHorario as $value ) {
			array_push($grupo_dias, $value->dia);
		}

		foreach ($model->GrupoHorario as $value) {
		  	$d['horario_desde'] = $value->horario_desde;
		  	$d['horario_hasta'] = $value->horario_hasta;
			array_push($dias_horas, $d);
		}

		// Cambio Fecha FIN
		// Si la fecha es anterior se eliminan las clases de más
		if( $data['fecha_fin'] < $model->fecha_fin ){
			for( $i = $data['fecha_fin']; $i <= $fin; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
				foreach ($clases as $clase) {
					$claseFecha = explode(" ", $clase->fecha);
					if ( $claseFecha[0] > $data['fecha_fin'])
						$clase->delete();
				}
			}
		}
		elseif( $data['fecha_fin'] > $model->fecha_fin ){
			for( $i = $fin; $i <= $data['fecha_fin']; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
				$contador = 0;
				$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
				$fecha = $dias[date('N', strtotime($i))];
				if (in_array($fecha, $grupo_dias)) {
				    // Cargo fecha
				    if ($i >= date('Y-m-d'))
				    	$data['clase_estado_id'] = 1;
				    else
				    	$data['clase_estado_id'] = 2;

				    $data['grupo_id'] 		 = $model->id;
				    $data['fecha'] 			 = $i;
				    $data['docente_id'] 	 = $model->docente_id;
				    $data['descripcion'] 	 = '(La clase no tiene descripción)';
				    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
				    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
				    $data['enviado'] 	 	 = 0;
				    $this->claseRepo->create($data);
				}
				$contador ++;
			}
		}

		$data['filial_id'] = session('usuario')['entidad_id'];

		$this->grupoRepo->edit($model,$data);
		return redirect()->route('grupos.index')->with('msg_ok', 'Grupo editado correctamente');
	}

	public function borrar($id){
		$grupo 			= $this->grupoRepo->find($id);
		$grupo->activo 	= 0;
		if ($grupo->save())
			return redirect()->back()->with('msg_ok', 'Grupo eliminado correctamente');
		else
			return redirect()->back()->with('msg_error', 'El Grupo no ha podido ser eliminado');
	}


	public function clases()
	{
		$filial = session('usuario')['entidad_id'];
		$grupos = $this->grupoRepo->all()->lists('full_name', 'id');
		$docentes = $this->docenteRepo->all()->lists('full_name', 'id');
		$events = $this->claseRepo->all();

		return view('rol_filial.grupos.clases', compact('grupos', 'docentes', 'events', 'filial'));
	}

	public function nueva_clase(Request $request)
	{
		$data = $request->all();
		$this->claseRepo->create($data);
		return redirect()->back()->with('msg_ok', 'Clase creada correctamente');
		
	}

	public function editar_clase(Request $request)
	{
		$clase_id = $request->clase_id;
		$data = $request->all();
		$clase = $this->claseRepo->find($clase_id);
		$this->claseRepo->edit($clase,$data);
		return redirect()->back()->with('msg_ok', 'Clase editada correctamente');
	}

	public function editar_clase_arrastrando(Request $request)
	{	
		$clase= $request->get('Event');

		$id = $clase[0];
		$fecha = explode(' ',$clase[1]);
 		$model = $this->claseRepo->find($id);
		$model->fecha = $fecha[0];
		$model->save();
		if($model)
				echo json_encode('La clase se ha editado correctamente.');
			else
				echo json_encode('Ha ocurrido un error al editar la clase.');
		
		
	}

	public function buscar_clase(Request $request)
    {
        $clase_id = $request->get('clase_id');
        $clase = $this->claseRepo->find($clase_id);
        $grupo_matricula = GrupoMatricula::where('grupo_id', $clase->grupo_id)->count();
        $clase->cantidad_personas = $grupo_matricula;
        
        return response()->json($clase, 200);
 
    }

	public function borrar_clase($id = null)
	{
		dd($id);
	}

	public function clase_matricula($data)
	{
		$clase = $this->claseRepo->find($data);
		$grupo_matricula = GrupoMatricula::where('grupo_id', $clase->grupo_id)->get();
		
		$clase_matricula = ClaseMatricula::where('clase_id', $clase->id)->get();		
     	$search = $this->claseMatriculaRepo;
     
		return view('rol_filial.grupos.clase_matricula', compact('clase', 'grupo_matricula', 'clase_matricula', 'search'));
	}

	public function cargar_clase(Request $request)
	{
		$clase_id = $request->get('clase_id');
		$clase = $this->claseRepo->find($clase_id);
		$clase->Matricula()->detach();
		$data = $request->all();
		$asistio = $request->get('asistio');
	
		//$clase->Matricula()->sync($data);
		if($asistio)
			foreach ($asistio as $a) {

			list($matricula, $valor) = array_divide($a);
			
			$clase_matricula = new ClaseMatricula;
			$clase_matricula->asistio = $valor[0];
			$clase_matricula->matricula_id = $matricula[0];			
			$clase_matricula->clase_id = $clase_id;
			$clase_matricula->save();
				    
		}
		return redirect()->back()->with('msg_ok', 'Asistencia creado correctamente');
	}

	public function post_materias_carreras(Request $request){	
		$carrera_id = $request->get('carrera_id');
		$carrera = $this->carreraRepo->find($carrera_id);
		$materia = $carrera->Materia;
		return response()->json($materia, 200);
	}
}
