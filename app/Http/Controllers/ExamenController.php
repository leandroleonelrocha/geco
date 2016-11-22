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
		$grupos = $this->grupoRepo->all()->lists('full_name', 'id');
		$docentes = $this->docenteRepo->all()->lists('full_name','id');

		
		return view('rol_filial.examenes.lista', compact('examenes', 'grupos', 'docentes'));
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
 		$longitud = count($request->matricula);
 		$data = $request->all();
 		$ultimo = $this->examenRepo->all()->last()->nro_acta + 1;
 		
        for($i=0;$i<$longitud;$i++) {
        	$data['nro_acta'] = $ultimo;
        	$data['matricula_id'] = $request->matricula[$i];
            $data['nota'] = $request->nota[$i];
           	$this->examenRepo->create($data);

        }

		//$this->examenPermisosRepo->create($data);
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

	public function grupos_examenes(Request $request)
    {
        $grupo_id = $request->get('grupo_id');
        $grupo = $this->grupoRepo->find($grupo_id);
       	$carrera = $grupo->Carrera;
       	$materias = $grupo->Carrera->Materia;
        $matriculas = $grupo->Matricula;

        return response()->json(array('grupo'=>$grupo, 'carrera'=>$carrera,'materias'=>$materias,'matriculas'=>$matriculas));
    }



}