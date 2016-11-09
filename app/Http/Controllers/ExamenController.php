<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\ExamenPermisosRepo;
use App\Http\Repositories\MatriculaRepo;
use App\Http\Repositories\DocenteRepo;
use App\Http\Repositories\GrupoRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\MateriaRepo;

class ExamenController extends Controller
{

	protected $examenRepo;
	protected $examenPermisosRepo;
	protected $matriculaRepo;
	protected $docenteRepo;
	protected $grupoRepo;
	protected $carreraRepo;
	protected $materiaRepo;

	public function __construct(ExamenRepo $examenRepo, ExamenPermisosRepo $examenPermisosRepo, MatriculaRepo $matriculaRepo, DocenteRepo $docenteRepo, GrupoRepo $grupoRepo, CarreraRepo $carreraRepo, MateriaRepo $materiaRepo){
		
		$this->examenRepo = $examenRepo;
		$this->examenPermisosRepo = $examenPermisosRepo;
		$this->matriculaRepo = $matriculaRepo;
		$this->docenteRepo = $docenteRepo;
		$this->grupoRepo = $grupoRepo;
		$this->carreraRepo = $carreraRepo;
		$this->materiaRepo = $materiaRepo;
	}
	
	public function index(){
	
		$examenes = $this->examenRepo->all();

		
		return view('rol_filial.examenes.lista', compact('examenes'));
	}

	public function nuevo()
	{
		//matriculaspermisos
		//Docentes
		
		$matriculas = $this->matriculaRepo->allEneable()->lists('id', 'id');
		
		$grupos = $this->grupoRepo->all()->lists('descripcion', 'id');
		$carreras = $this->carreraRepo->all()->lists('nombre', 'id');
		$materias = $this->materiaRepo->all()->lists('nombre', 'id');
		$docentes = $this->docenteRepo->all()->lists('full_name', 'id');
		
		return view('rol_filial.examenes.form',compact('matriculas', 'grupos', 'carreras', 'materias', 'docentes'));
	}

	public function nuevo_post(Request $request)
	{
		$this->examenRepo->create($request->all());

		$data['nro_acta'] = $request->get('nro_acta');
		$data['matricula_id'] = $request->get('matricula_id');
		$data['filial_id'] = session('usuario')['entidad_id'];

		$this->examenPermisosRepo->create($data);
		return redirect()->route('filial.examenes')->with('msg_ok', 'Examen creado correctamente.');
	}


	public function editar(Request $request, $id = null)
	{
		
		$model = $this->examenRepo->find($id);


		$matriculas = $this->matriculaRepo->allEneable()->lists('id', 'persona_id');
		$grupos = $this->grupoRepo->all()->lists('descripcion', 'id');
		$carreras = $this->carreraRepo->all()->lists('nombre', 'id');
		$materias = $this->materiaRepo->all()->lists('nombre', 'id');
		$docentes = $this->docenteRepo->all()->lists('full_name', 'id');

		return view('rol_filial.examenes.form',compact('matriculas', 'grupos', 'carreras', 'materias', 'docentes','model'));

	}

	public function editar_post(Request $request ,$id = null)
	{
		
		$model = $this->examenRepo->find($id);
		$data = $request->all();
		$this->examenRepo->edit($model, $data);
		/*
		$examenPermisos = $this->examenPermisosRepo->find($id);
		$data['nro_acta'] = $request->get('nro_acta');
		$data['matricula_id'] = $request->get('matricula_id');
		$data['filial_id'] = session('usuario')['entidad_id'];
		$this->examenPermisosRepo->edit($examenPermisos, $data);
		*/
		return redirect()->route('filial.examenes')->with('msg_ok', 'Examen editado correctamente.');		

	}	



}