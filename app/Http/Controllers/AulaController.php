<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\Aula;
use App\Entities\GrupoHorario;
use App\Http\Repositories\AulaRepo;
use App\Http\Repositories\GrupoRepo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaAulaRequest;
use App\Http\Requests\EditarAulaRequest;
use App\Http\Requests\CrearNuevaCarreraRequest;
use App\Http\Requests\EditarCarreraRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\PaisRepo;
use App\Http\Repositories\MateriaRepo;



class AulaController extends Controller
{
	protected $aulaRepo;

	public function __construct(MateriaRepo $materiaRepo, CursoRepo $cursoRepo, AulaRepo $aulaRepo,GrupoRepo $grupoRepo,CarreraRepo $carreraRepo, PaisRepo $paisRepo, FilialRepo $filialRepo)
	{
		$this->aulaRepo 	= $aulaRepo;
		$this->grupoRepo 	= $grupoRepo;
		$this->carreraRepo  = $carreraRepo;
		$this->paisRepo 	= $paisRepo;
		$this->filialRepo 	= $filialRepo;
		$this->cursoRepo 	= $cursoRepo;
		$this->materiaRepo 	= $materiaRepo;
	}

	public function lista(){

	}

	public function nuevo(){

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);
		$cadena 	= $this->filialRepo->filialCadena();
		
		$carreras=$this->carreraRepo->allCarreras($pais->lenguaje,$cadena->cadena_id);

		$grupos=$this->grupoRepo->allEnable();
		$aulas= $this->aulaRepo->allAulas();
		$cursos = $this->cursoRepo->allCursos($pais->lenguaje,$cadena->cadena_id);

		$materia=$this->materiaRepo->allMaterias($cadena->cadena_id);

		return view('rol_filial.grupos.asignacionAula.nuevo',compact('grupos','aulas','carreras','cursos','materia'));	  
	}


	public function nuevo_post(CrearNuevaAulaRequest $request){
	 	$data = $request->all();
	 	$aula['filial_id'] 	= session('usuario')['entidad_id'];
		foreach ($data['nombre'] as $key) {
			$aula['nombre'] = $key;;
			$this->aulaRepo->create($aula);
		}
		return redirect()->back()->with('msg_ok', 'Aulas asignadas correctamente');
	}

	public function editar($id){

		$aula = $this->aulaRepo->find($id);
		return view('rol_filial.grupos.asignacionAula.editar',compact('aula'));

	}


    public function editar_post(EditarAulaRequest $request){
    	
		$data = $request->all();
		$model = $this->aulaRepo->find($data['id']);
		if($this->aulaRepo->edit($model,$data))
		    return redirect()->route('filial.asignacionAulas_nuevo')->with('msg_ok','El nombre de aula ha sido modificado con éxito');
		else
		    return redirect()->route('filial.asignacionAulas_editar')->with('msg_error','El nombre de aula  no ha podido ser modificada.');
		
    }
}