<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\Curso;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevoCursoRequest;
use App\Http\Requests\EditarCursoRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\paisRepo;

class CursoController extends Controller
{
	protected $cursoRepo;

	public function __construct(CursoRepo $cursoRepo, PaisRepo $paisRepo, FilialRepo $filialRepo)
	{
		$this->cursoRepo = $cursoRepo;
		$this->paisRepo = $paisRepo;
		$this->filialRepo = $filialRepo;
	}

	public function lista(){

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);
		
		$cursos = $this->cursoRepo->allCursos($pais->lenguaje);

		return view('rol_filial.cursos.lista',compact('cursos'));
	}

	public function nuevo()
	{
		return view('rol_filial.cursos.nuevo');	
	}

	public function nuevo_post(CrearNuevoCursoRequest $request){
		
		$data = $request->all();

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);

		$data['lenguaje'] =$pais->lenguaje;
		$this->cursoRepo->create($data);
		return redirect()->route('filial.cursos')->with('msg_ok', 'Curso creado correctamente');
	}

  	public function editar($id){
  		
		$curso = $this->cursoRepo->find($id);
		return view('rol_filial.cursos.editar',compact('curso'));	
    }

    public function editar_post(EditarCursoRequest $request){
    	
		$data = $request->all();
		$model = $this->cursoRepo->find($data['id']);
		if($this->cursoRepo->edit($model,$data))
			return redirect()->route('filial.cursos')->with('msg_ok','El curso ha sido modificado con éxito');
		else
			return redirect()->route('filial.cursos')->with('msg_error','El curso no ha podido ser modificado.');
    }

    public function borrar($id){
    	
		if($data=$this->cursoRepo->find($id))
		{
	    	$data->Delete();
	        return redirect()->back()->with('msg_ok', 'Curso eliminado correctamente');
	    	}
        else
        	return redirect()->back()->with('msg_error','El curso no ha podido ser eliminada.');
    }
}