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
use App\Http\Repositories\AulaRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\PaisRepo;
use App\Entities\Clase;
use App\Entities\GrupoMatricula;
use App\Entities\ClaseMatricula;
use App\Entities\GrupoHorario;
use App\Http\Requests\CrearNuevoGrupoRequest;
use PDF;


class GrupoController extends Controller
{
	protected $cursoRepo;
	protected $carreraRepo;
	protected $materiaRepo;
	protected $docenteRepo;
	protected $grupoRepo;
	protected $claseRepo;
	protected $claseMatriculaRepo;

	public function __construct(CursoRepo $cursoRepo, CarreraRepo $carreraRepo, MateriaRepo $materiaRepo, DocenteRepo $docenteRepo, GrupoRepo $grupoRepo, ClaseRepo $claseRepo , ClaseMatriculaRepo $claseMatriculaRepo, AulaRepo $aulaRepo, FilialRepo $filialRepo, PaisRepo $paisRepo)
	{
		$this->cursoRepo 			= $cursoRepo;
		$this->carreraRepo 			= $carreraRepo;
		$this->materiaRepo 			= $materiaRepo;
		$this->docenteRepo 			= $docenteRepo;
		$this->grupoRepo 			= $grupoRepo;
		$this->claseRepo 			= $claseRepo;
		$this->claseMatriculaRepo 	= $claseMatriculaRepo;
		$this->aulaRepo 			= $aulaRepo;
		$this->filialRepo 			= $filialRepo;
		$this->paisRepo 			= $paisRepo;
		
	}	

	public function index(){
		$grupos = $this->grupoRepo->allEnable();
		return view('rol_filial.grupos.index', compact('grupos'));
	}

	public function nuevo(){

        $filial=$this->filialRepo->obtenerFilialPais();
        foreach ($filial as $f) $pais_id=$f->pais_id;
        $pais=$this->paisRepo->obtenerLenguaje($pais_id);

        $cadena     = $this->filialRepo->filialCadena();
        $carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
		// $materias 	= $this->materiaRepo->lists('nombre','id');
		$docentes 	= $this->docenteRepo->allEneable()->lists('apellidos', 'id');
		$aulas		= $this->aulaRepo->allAulas()->lists('nombre', 'id');
		return view('rol_filial.grupos.form', compact('cursos', 'carreras','docentes', 'aulas'));
	}

	public function edit($id){

        $filial=$this->filialRepo->obtenerFilialPais();
        foreach ($filial as $f) $pais_id=$f->pais_id;
        $pais=$this->paisRepo->obtenerLenguaje($pais_id);

		$model 		= $this->grupoRepo->find($id);
        $cadena     = $this->filialRepo->filialCadena();
        $carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        if(isset($model->Carrera))
		$materias 	= $model->Carrera->Materia->lists('nombre','id');
		$docentes 	= $this->docenteRepo->all()->lists('apellidos', 'id');
		$aulas		= $this->aulaRepo->allAulas()->lists('nombre', 'id');
		return view('rol_filial.grupos.form', compact('model', 'cursos', 'carreras', 'materias', 'docentes', 'aulas'));
	}

	public function postAdd(Request $request){
        $data 			  = $request->all();

        $array 			  = explode("-", $request->get('fecha'));
		$carrearas_cursos = explode(';',$request->carreras_cursos);
            if ($carrearas_cursos[0] == 'carrera')
                $data['carrera_id']    =   $carrearas_cursos[1];
            elseif ($carrearas_cursos[0] == 'curso')
                $data['curso_id']      =   $carrearas_cursos[1];	
		$data['filial_id'] 		= session('usuario')['entidad_id'];

		// if ( $data['fecha_inicio'] < date("Y-m-d") ) {
		// 	return redirect()->back()->with('msg_error', 'La fecha de inicio no puede ser anterior a la fecha actual.');
		// }

        $finicio 	= $request->fecha_inicio[0];
        $longitud 	= count($request->aula_id);
		for($i = 0; $i < $longitud; $i++) {
			// Determina la fecha de incio del Grupo
			if($finicio > $request->fecha_inicio[$i])
				$finicio = $request->fecha_inicio[$i];
			// Determina la fecha de fin del Grupo
			$cantClases = $request->cantidad_clases[$i] - 1; // -1 por la clase de inicio
			$inicio 	= $request->fecha_inicio[$i]; 		 // Inicio de la Materia
			$fin[] 		= date('Y-m-d', strtotime("+$cantClases week", strtotime($inicio)));
			$ffin 		= $fin[0];
			if($ffin < $fin[$i]) $ffin = $fin[$i];
        }
        $data['fecha_inicio'] = $finicio;
        $data['fecha_fin'] = $ffin;
		
		// Creación del grupo
		if (isset($data['teorica_practica'])) {
			if ($data['teorica_practica'] == "practica"){
				$data['practica'] = true;
				$data['teorica']  = false;
			}
			if ($data['teorica_practica'] == "teorica"){
				$data['teorica']  = true;
				$data['practica'] = false;
			}
		}
		else{
			$data['teorica']  = true;
			$data['practica'] = true;
		}

		$this->grupoRepo->create($data);

        $grupo 	= $this->grupoRepo->all()->last();

        for($i=0; $i < $longitud; $i++) {
        	$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
			$data['dia'] 			 = $dias[date('N', strtotime($request->fecha_inicio[$i]))];
            $data['horario_desde'] 	 = $request->horario_desde[$i];
            $data['horario_hasta'] 	 = $request->horario_hasta[$i];
            $data['materia_id'] 	 = $request->materia_id[$i];
            $data['fecha_inicio'] 	 = $request->fecha_inicio[$i];
            $data['cantidad_clases'] = $request->cantidad_clases[$i];
            $data['aula_id'] 		 = $request->aula_id[$i];
            $data['grupo_id']		 = $grupo->id;
            $grupo->GrupoHorario()->create($data);
        }

		$grupo_dias 	= [];
		$dias_horas 	= [];
		$materia 		= [];
		$materiaInicio 	= [];
		$materiaClases 	= [];
		$aula 			= [];
        $ultimo 		= $this->grupoRepo->all()->last();
        foreach ($ultimo->GrupoHorario as $value ) {
			array_push($grupo_dias, $value->dia);
		}

		foreach ($ultimo->GrupoHorario as $value ) {
		  	$d['horario_desde'] = $value->horario_desde;
		  	$d['horario_hasta'] = $value->horario_hasta;
		  	if (isset($value->materia_id)){
		  		$m['materia_id'] = $value->materia_id;
		  		array_push($materia, $m);
		  		array_push($materiaInicio, $value->fecha_inicio);
				array_push($materiaClases, $value->cantidad_clases);
		  	}
		  	$a['aula_id'] = $value->aula_id;
			array_push($dias_horas, $d);
			array_push($aula, $a);
		}

		$fecha1 = date("Y-m-d", strtotime($ultimo->fecha_inicio));
		$fecha2 = date("Y-m-d", strtotime($ultimo->fecha_fin));
		$contador = 0;
		for($i = $fecha1;$i <= $fecha2; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
			$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
			$fecha = $dias[date('N', strtotime($i))];
			if (in_array($fecha, $grupo_dias) && $fecha >= $materiaInicio[$contador] && $fecha <= $materiaClases[$contador]) {
			    // Cargo fecha
			    if ($i >= date('Y-m-d'))
			    	$data['clase_estado_id'] = 1;
			    else
			    	$data['clase_estado_id'] = 2;
			    $data['grupo_id'] 		 = $ultimo->id;
			    $data['fecha'] 			 = $i;
			    $data['docente_id'] 	 = $ultimo->docente_id;
			    if (!empty($materia[$contador]['materia_id'])){
			    	$mat  = $this->materiaRepo->find($materia[$contador]['materia_id']);
			    	$data['descripcion']  = $ultimo->descripcion.' - '.$mat->nombre;
			    	$data['materia_id']   = $materia[$contador]['materia_id'];
			    }
			    else
			    	$data['descripcion'] = $ultimo->descripcion;
			    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
			    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
			    $data['aula_id'] 		 = $aula[$contador]['aula_id'];
			    $data['enviado'] 	 	 = 0;
			    $this->claseRepo->create($data);
				$contador ++;
				if( $contador == count($ultimo->GrupoHorario) )
					$contador = 0;
			}
		}

		// $fecha1 = date("Y-m-d", strtotime($ultimo->fecha_inicio));
		// $fecha2 = date("Y-m-d", strtotime($ultimo->fecha_fin));
		// $contador = 0;
		// for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
		// 	$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
		// 	$fecha = $dias[date('N', strtotime($i))];

		// 	if (in_array($fecha, $grupo_dias)) {
		// 	    // Cargo fecha
		// 	    if ($i >= date('Y-m-d'))
		// 	    	$data['clase_estado_id'] = 1;
		// 	    else
		// 	    	$data['clase_estado_id'] = 2;
		// 	    $data['grupo_id'] 		 = $ultimo->id;
		// 	    $data['fecha'] 			 = $i;
		// 	    $data['docente_id'] 	 = $ultimo->docente_id;
		// 	    if (!empty($materia[$contador]['materia_id'])){
		// 	    	$mat  = $this->materiaRepo->find($materia[$contador]['materia_id']);
		// 	    	$data['descripcion']  = $ultimo->descripcion.' - '.$mat->nombre;
		// 	    	$data['materia_id']   = $materia[$contador]['materia_id'];
		// 	    }
		// 	    else
		// 	    	$data['descripcion'] = $ultimo->descripcion;
		// 	    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
		// 	    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
		// 	    $data['aula_id'] 		 = $aula[$contador]['aula_id'];
		// 	    $data['enviado'] 	 	 = 0;
		// 	    $this->claseRepo->create($data);
		// 		$contador ++;
		// 		if( $contador == count($ultimo->GrupoHorario) )
		// 			$contador = 0;
		// 	}
		// }
        return redirect()->route('grupos.index')->with('msg_ok', 'Grupo creado correctamente');
    }

	public function postEdit($id, CrearNuevoGrupoRequest $request){
		$model 	= $this->grupoRepo->find($id);
		$data 	= $request->all();
		$grupos = $this->grupoRepo->allEnable();
		
		if (!empty($grupos)) {
	        foreach ($grupos as $grupo) {
	        	foreach ($grupo->GrupoHorario as $horario) {
		        	for ($i=0; $i < count($data['aula_id']); $i++) {
		        		$hora = date("h:i:s", strtotime($data['horario_desde'][$i]));
		        		$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
		        		$dia = $dias[$data['dia'][$i]];

		        		if( ( $data['aula_id'][$i] == $horario->aula_id ) && ( $dia == $horario->dia ) && ( $hora >= $horario->horario_desde && $hora < $horario->horario_hasta ) ){
		        			$aula = $this->aulaRepo->find($data['aula_id'][$i]);
		        			return redirect()->back()->with('msg_error', 'El aula '.$aula->nombre.' ya se está reservada el día '.$dia.' al horario ingresado por el grupo '.$grupo->descripcion.'.');
		        		}
		        	}
	        	}
	        }
        }

		$array 					= explode("-", $request->get('fecha'));
		$data['fecha_inicio'] 	= date("Y-m-d", strtotime($array[0]));
		$data['fecha_fin'] 		= date("Y-m-d", strtotime($array[1]));

		if ( $data['fecha_inicio'] < date("Y-m-d") ) {
			return redirect()->back()->with('msg_error', 'La fecha de inicio no puede ser anterior a la fecha actual.');
		}
		
		$grupo_dias 			= [];
		$dias_horas 			= [];
		$materia 				= [];
		$aula 					= [];
		$inicio 				= date("Y-m-d", strtotime($model->fecha_inicio));
		$fin 					= date("Y-m-d", strtotime($model->fecha_fin));
		$clases 				= $this->claseRepo->findAllClaseGrupo($model->id);
		
		$data['filial_id'] = session('usuario')['entidad_id'];
		

		$carrearas_cursos = explode(';',$request->carreras_cursos);
        	if ($carrearas_cursos[0] == 'carrera'){
        		$data['curso_id']     =	null;
        		$data['carrera_id']   =	$carrearas_cursos[1];
        	}
             
            if ($carrearas_cursos[0] == 'curso'){
                $data['curso_id']     =	$carrearas_cursos[1];
            	$data['materia_id']   =	null;
            	$data['carrera_id']   =	null; 		
	        }

	    // Validar que Fecha INICIO no se cambia si ya comenzo
		foreach ($clases as $clase) {
			if ($data['fecha_inicio'] > $clase->fecha && $data['fecha_inicio'] < date("Y-m-d")) {
				return redirect()->back()->with('msg_error', 'No se puede cambiar la fecha de inicio, ya hay clases transcurridas.');
			}
		}
   		
		// Validar que Fecha FIN no sea anterior a una clase finalizada (ESTADO = 3)
		foreach ($clases as $clase) {
			if ($data['fecha_fin'] < $clase->fecha && $clase->clase_estado_id == 3) {
				return redirect()->back()->with('msg_error', 'Hay clases finalizadas posterior a la fecha de FIN ingresada, ingresa una fecha de fin posterior.');
			}
		}

		// Edicion de dia y horario del grupo
		$model->GrupoHorario()->delete(); 
 		$longitud = count($request->dia);
        for($i=0;$i<$longitud;$i++) {
            $d['dia'] 				= $request->dia[$i];
            $d['horario_desde'] 	= $request->horario_desde[$i];
            $d['horario_hasta'] 	= $request->horario_hasta[$i];
            if (isset($request->materia_id[$i]))
            	$d['materia_id'] 	= $request->materia_id[$i];
            $d['aula_id'] 			= $request->aula_id[$i];
            $model->GrupoHorario()->create($d);
        }

        // Cambio Fecha INICIO
        // Si la fecha es anterior se crean las nuevas clases
        if( $data['fecha_inicio'] < $model->fecha_inicio ){
			$contador = 0;
			for( $i = $data['fecha_inicio']; $i <= $inicio; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
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
					if (!empty($materia[$contador]['materia_id'])){
				    	$mat  = $this->materiaRepo->find($materia[$contador]['materia_id']);
				    	$data['descripcion']  = $ultimo->descripcion.' - '.$mat->nombre;
				    	$data['materia_id']   = $materia[$contador]['materia_id'];
				    }
				    else
				    	$data['descripcion'] = $ultimo->descripcion;
				    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
				    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
				    $data['aula_id'] 		 = $aula[$contador]['aula_id'];
				    $data['enviado'] 	 	 = 0;
				    $this->claseRepo->create($data);
				    $contador ++;
					if( $contador == count($ultimo->GrupoHorario) )
						$contador = 0;
				}
			}
		}
		elseif( $data['fecha_inicio'] > $model->fecha_inicio ){
			// Si la fecha es posterior a la anterior se eliminan las clases de más
			for( $i = $data['fecha_inicio']; $i >= $inicio; $i = date("Y-m-d", strtotime($i ."- 1 days"))){
				foreach ($clases as $clase) {
					$claseFecha = explode(" ", $clase->fecha);
					if ( $claseFecha[0] < $data['fecha_inicio'])
						$clase->delete();
				}
			}
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
			$contador = 0;
			for( $i = $fin; $i <= $data['fecha_fin']; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
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
					if (!empty($materia[$contador]['materia_id'])){
				    	$mat  = $this->materiaRepo->find($materia[$contador]['materia_id']);
				    	$data['descripcion']  = $ultimo->descripcion.' - '.$mat->nombre;
				    	$data['materia_id']   = $materia[$contador]['materia_id'];
				    }
				    else
				    	$data['descripcion'] = $ultimo->descripcion;
				    $data['horario_desde'] 	 = $dias_horas[$contador]['horario_desde'];
				    $data['horario_hasta'] 	 = $dias_horas[$contador]['horario_hasta'];
				    $data['aula_id'] 		 = $aula[$contador]['aula_id'];
				    $data['enviado'] 	 	 = 0;
				    $this->claseRepo->create($data);
				    $contador ++;
					if( $contador == count($ultimo->GrupoHorario) )
						$contador = 0;
				}
			}
		}

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
        $clase->clase_aula 			  = $clase->Aula->nombre;
        
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
		$tp 		= $request->get('tp');
		// $carrera = $this->carreraRepo->find($carrera_id);
		// $materia = $carrera->Materia;
		$materias = $this->materiaRepo->findMateriasCarrera($carrera_id, $tp);
		return response()->json($materias, 200);
	}

	public function post_materias_cursos(Request $request){	
		$curso_id = $request->get('curso_id');
		$materias = $this->materiaRepo->findMateriasCurso($curso_id);
		return response()->json($materias, 200);
	}

	public function imprimir_asistencias($id){
		$grupo      = $this->grupoRepo->find($id);
		$matriculas = $grupo->Matricula;
		$clases     = $this->grupoRepo->clasesMesActual();
		
		$pdf    	= PDF::loadView('impresiones.asistencias',compact('grupo','matriculas','clases'));
		return $pdf->stream();

	}



}
