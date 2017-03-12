<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaMateriaRequest;
use App\Http\Requests\EditarMateriaRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\MateriaRepo;
use App\Http\Repositories\MateriaCarreraCursoRepo;
use App\Http\Repositories\PaisRepo;


class MateriaController extends Controller
{
	protected $materiaRepo;

	public function __construct(MateriaRepo $materiaRepo, CarreraRepo $carreraRepo, CursoRepo $cursoRepo, FilialRepo $filialRepo, PaisRepo $paisRepo, MateriaCarreraCursoRepo $materiaCarreraCursoRepo)
	{
		$this->materiaRepo 	= $materiaRepo;
		$this->carreraRepo 	= $carreraRepo;
		$this->cursoRepo 	= $cursoRepo;
		$this->filialRepo 	= $filialRepo;
		$this->paisRepo 	= $paisRepo;
		$this->materiaCarreraCursoRepo 	= $materiaCarreraCursoRepo;
	}

	public function lista(){

		$cadena = $this->filialRepo->filialCadena();
		$materia=$this->materiaRepo->allMaterias($cadena->cadena_id);
		return view('rol_filial.materias.lista',compact('materia'));
	}

	public function nuevo(){

		$filial 	= $this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		
		$pais 		= $this->paisRepo->obtenerLenguaje($pais_id);
		$cadena 	= $this->filialRepo->filialCadena();
		// $carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
  //       $cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $carreras   = $this->carreraRepo->lenguajeCadenaLista('nombre','id',$pais->lenguaje,$cadena->cadena_id);
        $cursos     = $this->cursoRepo->lenguajeCadenaLista('nombre','id',$pais->lenguaje,$cadena->cadena_id);
		return view('rol_filial.materias.nuevo', compact('carreras', 'cursos'));	
	}

	public function nuevo_post(CrearNuevaMateriaRequest $request){

		$materia = $request->all();
		$cadena 	= $this->filialRepo->filialCadena();
		$materia['cadena_id'] =$cadena->cadena_id;

        
		if (isset($materia["teorica_practica"])) {
			if ($materia["teorica_practica"] == 1){
				$materia["practica"] = true;
				$materia["teorica"]  = false;
			}
			else{
				$materia["practica"] = false;
				$materia["teorica"]  = true;
			}
		}
		else{
			$materia["practica"] = true;
			$materia["teorica"]  = true;
		}
		$this->materiaRepo->create($materia);
		$data=$this->materiaRepo->all()->last();

		// $carrearas_cursos = explode(';',$request->carreras_cursos);
		
		// if ($carrearas_cursos[0] == 'carrera'){
		// 	$m['materia_id'] 	=	$data['id'];
  //           $m['carrera_id']    =   $carrearas_cursos[1];
		// }
  //       elseif ($carrearas_cursos[0] == 'curso'){
		// 	$m['materia_id'] 	=	$data['id'];
  //           $m['curso_id']      =   $carrearas_cursos[1];
  //       }
		if (isset($materia['curso'])) {

			for ($i=0; $i < count($materia['curso']); $i++) {
				$m['materia_id'] = $data['id'];
				$m['curso_id'] = $materia['curso'][$i];
				$m['carrera_id'] = null;
				$this->materiaCarreraCursoRepo->create($m);
			}
		}
		if (isset($materia['carrera'])) {
			for ($i=0; $i < count($materia['carrera']); $i++) {
				$m['materia_id'] = $data['id'];
				$m['carrera_id'] = $materia['carrera'][$i];
				$m['curso_id'] = null;
				$this->materiaCarreraCursoRepo->create($m);
			}
		}
    	// $this->materiaCarreraCursoRepo->create($m);
		return redirect()->route('filial.asignacionAulas_nuevo')->with('msg_ok', 'Materia creada correctamente');
	}

 	public function editar($id){

		$filial=$this->filialRepo->obtenerFilialPais();
		foreach ($filial as $f) $pais_id=$f->pais_id;
		
		$pais=$this->paisRepo->obtenerLenguaje($pais_id);
		$cadena 	= $this->filialRepo->filialCadena();
		$carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
      	$cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);

		$materia = $this->materiaRepo->find($id);
		$materiaCarreraCurso=$this->materiaCarreraCursoRepo->findMateriaCarreraCurso($materia->id);
		return view('rol_filial.materias.editar',compact('materia','carreras','cursos','materiaCarreraCurso'));	
    }

    public function editar_post(EditarMateriaRequest $request){
		$data = $request->all();

		// $carrearas_cursos = explode(';',$request->carreras_cursos);
        
  //       if ($carrearas_cursos[0] == 'carrera'){
  //           $m['carrera_id']    =   $carrearas_cursos[1];
  //       	$m['curso_id']=NULL;
  //       }
  //       elseif ($carrearas_cursos[0] == 'curso'){
  //           $m['curso_id']      =   $carrearas_cursos[1];
  //       	$m['carrera_id'] =NULL;
  //       }

		if (isset($data["teorica_practica"])) {
			if ($data["teorica_practica"] == 1){
				$data["practica"] = 1;
				$data["teorica"]  = 0;
			}
			else{
				$data["practica"] = 0;
				$data["teorica"]  = 1;
			}
		}
		$model = $this->materiaRepo->find($data['id']);
		$modelm=$this->materiaCarreraCursoRepo->findMateriaCarreraCurso($data['id']);
		foreach ($modelm as $mm) { $mm->delete(); }
		
		if($this->materiaRepo->edit($model,$data))	{

			if (isset($data['curso'])) {

				for ($i=0; $i < count($data['curso']); $i++) {
					$m['materia_id'] = $data['id'];
					$m['curso_id'] = $data['curso'][$i];
					$m['carrera_id'] = null;
					$this->materiaCarreraCursoRepo->create($m);
				}
			}
			if (isset($data['carrera'])) {
				for ($i=0; $i < count($data['carrera']); $i++) {
					$m['materia_id'] = $data['id'];
					$m['carrera_id'] = $data['carrera'][$i];
					$m['curso_id'] = null;
					$this->materiaCarreraCursoRepo->create($m);
				}
			}
        	return redirect()->route('filial.asignacionAulas_nuevo')->with('msg_ok','La materia ha sido modificada con éxito');}
		else
		    return redirect()->route('filial.asignacionAulas_nuevo')->with('msg_error','La materia no ha podido ser modificada.');	
    }

    public function borrar($id){
		if($data=$this->materiaRepo->find($id))
		{
	    	$data->Delete();
	        return redirect()->back()->with('msg_ok', 'Materia eliminada correctamente');
	        }
	    else
	       return redirect()->back()->with('msg_error','La materia no ha podido ser eliminada.');	
    }
}