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


	public function index()
	{

		$grupos = $this->grupoRepo->allEnable();
		
		return view('rol_filial.grupos.index', compact('grupos'));
	}

	public function nuevo()
	{
		$cursos = $this->cursoRepo->lists('nombre', 'id');
		$carreras = $this->carreraRepo->lists('nombre','id');
		$materias =  $this->materiaRepo->lists('nombre','id');
		$docentes = $this->docenteRepo->all()->lists('apellidos', 'id');
	
		return view('rol_filial.grupos.form', compact('cursos', 'carreras', 'materias','docentes'));
	}

	public function edit($id)
	{
		$model = $this->grupoRepo->find($id);

		$cursos = $this->cursoRepo->lists('nombre', 'id');
		$carreras = $this->carreraRepo->lists('nombre','id');
		$materias =  $this->materiaRepo->lists('nombre','id');
		$docentes = $this->docenteRepo->all()->lists('apellidos', 'id');
		return view('rol_filial.grupos.form', compact('model', 'cursos', 'carreras', 'materias', 'docentes'));

	}


	public function postAdd(Request $request)
	{
		//$data  = $request->only('curso_id', 'carrera_id', 'materia_id', 'descripcion', 'docente_id');

		$data = $request->all();
		$array = explode("-", $request->get('fecha'));
	
		$data['fecha_inicio'] = date("Y-m-d", strtotime($array[0]));
		$data['fecha_fin'] = date("Y-m-d", strtotime($array[1]));
		$data['filial_id'] = session('usuario')['entidad_id'];
	

		$this->grupoRepo->create($data);
		return redirect()->route('grupos.index')->with('msg_ok', 'Grupo creado correctamente');

	}

	public function postEdit($id, Request $request)
	{
		$model = $this->grupoRepo->find($id);
		
		$data = $request->all();
		$array = explode("-", $request->get('fecha'));
	
		$data['fecha_inicio'] = date("Y-m-d", strtotime($array[0]));
		$data['fecha_fin'] = date("Y-m-d", strtotime($array[1]));

		$data['filial_id'] = session('usuario')['entidad_id'];

		$this->grupoRepo->edit($model,$data);
		return redirect()->route('grupos.index')->with('msg_ok', 'Grupo editado correctamente');
	}


	public function clases()
	{
		$grupos = $this->grupoRepo->lists('descripcion', 'id');
		$docentes = $this->docenteRepo->all()->lists('full_name', 'id');
		$events = $this->claseRepo->all();
		return view('rol_filial.grupos.clases', compact('grupos', 'docentes', 'events'));
	}



	public function nueva_clase(Request $request)
	{
		$data = $request->all();
		//$fecha = explode(" ", $request->get('hora_desde'));
		//$data['hora_desde'] = $fecha[0];

		$this->claseRepo->create($data);
		return redirect()->back()->with('msg_ok', 'Clase creada correctamente');
		
	}

	public function editar_clase(Request $request)
	{
		dd($request->all());
	}

	public function editar_clase_arrastrando(Request $request)
	{
		$clase= $request->get('Event');

		$id = $clase[0];
		$fecha = $clase[1]; 
		$model = $this->claseRepo->find($id);		
		
		$model->fecha = $fecha;
		$model->save();
		if($model)
				echo json_encode('success');
			else
				echo json_encode('failed');
		
		
	}


	public function borrar_clase($id = null)
	{
		dd($id);
	}

	
	

	public function clase_matricula($data)
	{
		$clase = $this->claseRepo->find($data);
		$grupo_matricula = GrupoMatricula::where('grupo_id', $clase->grupo_id)->get();
		//$clase_matricula = ClaseMatricula::where('clase_id', $clase->id)->get();
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




}
