<?php

namespace App\Http\Repositories;
use App\Entities\Materia;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use DB;

class MateriaRepo extends BaseRepo {

    public function getModel()
    {
        return new Materia();
    }

    // public function findMateriasCarrera($carrera_id, $tp){
    // 	if ($tp == 'practica') {
    // 		return Materia::where('carrera_id', '=', $carrera_id)
    // 						->where('practica', '=', 1)
    // 						->get();
    // 	}
    // 	elseif($tp == 'teorica'){
    // 		return Materia::where('carrera_id', '=', $carrera_id)
    // 						->where('teorica', '=', 1)
    // 						->get();
    // 	}
    // }

    // public function findMateriasCurso($curso_id){
    //     return Materia::where('curso_id', '=', $curso_id)
    //                     ->where('practica', '=', 1)
    //                     ->where('teorica', '=', 1)
    //                     ->get();
    // }

    public function findAllMateriasCarrera($carrera_id){
        return DB::table('materia')
                   ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
                   ->join('carrera', 'carrera.id', '=', 'materia_carrera_curso.carrera_id')
                   ->select('materia.*', 'materia_carrera_curso.ano')
                   ->where('materia_carrera_curso.carrera_id', $carrera_id)
                   ->get();
    }

    // public function findAllMateriasCurso($curso_id){
    //     return DB::table('materia')
    //                ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
    //                ->join('curso', 'curso.id', '=', 'materia_carrera_curso.curso_id')
    //                ->select('materia.*')
    //                ->where('materia_carrera_curso.curso_id', $curso_id)
    //                ->get();
    // }

    public function findMateriasCarrera($carrera_id, $tp){
     if ($tp == 'practica') {
         return DB::table('materia')
                   ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
                   ->join('carrera', 'carrera.id', '=', 'materia_carrera_curso.carrera_id')
                   ->select('materia.*')
                   ->where('materia_carrera_curso.carrera_id', $carrera_id)
                   ->where('materia.practica', 1)
                   ->get();
     }
     elseif($tp == 'teorica'){
         return DB::table('materia')
                   ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
                   ->join('carrera', 'carrera.id', '=', 'materia_carrera_curso.carrera_id')
                   ->select('materia.*')
                   ->where('materia.teorica', 1)
                   ->get();
     }
    }

    public function findMateriasCarreraAño($carrera_id, $tp, $año){
        if ($tp == 'practica') {
            return DB::table('materia')
            ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
            ->join('carrera', 'carrera.id', '=', 'materia_carrera_curso.carrera_id')
            ->select('materia.*')
            ->where('materia_carrera_curso.carrera_id', $carrera_id)
            ->where('materia.practica', 1)
            ->where('materia_carrera_curso.ano', $año)
            ->get();
        }
        elseif($tp == 'teorica'){
            return DB::table('materia')
            ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
            ->join('carrera', 'carrera.id', '=', 'materia_carrera_curso.carrera_id')
            ->select('materia.*')
            ->where('materia.teorica', 1)
            ->where('materia_carrera_curso.ano', $año)
            ->get();
        }
    }

    public function findMateriasCurso($curso_id){
        // if ($tp == 'practica') {
        //     return DB::table('materia')
        //            ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
        //            ->join('curso', 'curso.id', '=', 'materia_carrera_curso.curso_id')
        //            ->select('materia.*')
        //            ->where('materia_carrera_curso.curso_id', $curso_id)
        //            ->where('materia.practica', 1)
        //            ->get();
        // }
        // elseif($tp == 'teorica'){
        //     return DB::table('materia')
        //            ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
        //            ->join('curso', 'curso.id', '=', 'materia_carrera_curso.curso_id')
        //            ->select('materia.*')
        //            ->where('materia_carrera_curso.curso_id', $curso_id)
        //            ->where('materia.teorica', 1)
        //            ->get();
        // }
      return DB::table('materia')
             ->join('materia_carrera_curso', 'materia.id', '=', 'materia_carrera_curso.materia_id')
             ->join('curso', 'curso.id', '=', 'materia_carrera_curso.curso_id')
             ->select('materia.*')
             ->where('materia_carrera_curso.curso_id', $curso_id)
             ->get();
    }

	public function deleteMateria($id){
        return Materia::where('id', '=', $id)->delete();
    }

    public function allMaterias($cad){
        return $this->model->where('cadena_id', $cad)->get();
    }

    public function allMateriasLista($data, $id,$cad){
        return $this->model->where('cadena_id', $cad)->lists($data, $id);
    }
}