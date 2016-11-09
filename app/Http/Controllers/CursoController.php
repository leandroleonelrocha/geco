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

class CursoController extends Controller
{
	protected $cursoRepo;

	public function __construct(CursoRepo $cursoRepo)
	{
		$this->cursoRepo = $cursoRepo;
	}
	
	public function lista(){
		if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
				$curso=$this->cursoRepo->all();
				return view('rol_filial.cursos.lista',compact('curso'));
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
	}

	public function nuevo(){
		if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
				return view('rol_filial.cursos.nuevo');
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
	}

	public function nuevo_post(CrearNuevoCursoRequest $request){
		if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
				$this->cursoRepo->create($request->all());
				return redirect()->route('filial.cursos')->with('msg_ok', 'Curso creado correctamente');
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
	}

  	public function editar($id){
  		if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
		    	$curso = $this->cursoRepo->find($id);
		    	return view('rol_filial.cursos.editar',compact('curso'));
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
    }

    public function editar_post(EditarCursoRequest $request){
    	if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
		        $data = $request->all();
		        $model = $this->cursoRepo->find($data['id']);
		        if($this->cursoRepo->edit($model,$data))
		            return redirect()->route('filial.cursos')->with('msg_ok','El curso ha sido modificado con éxito');
		        else
		            return redirect()->route('filial.cursos')->with('msg_error','El curso no ha podido ser modificado.');
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
    }

    public function borrar($id){
    	if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
			    if( $data=$this->cursoRepo->find($id))
			    {
		    	    $data->Delete();
		         	return redirect()->back()->with('msg_ok', 'Curso eliminado correctamente');
		         	}
		        else
		            return redirect()->back()->with('msg_error','El curso no ha podido ser eliminada.');
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
    }
}