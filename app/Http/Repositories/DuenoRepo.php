<?php
namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Entities\Preinforme;

use Illuminate\Support\Facades\Auth;


class DuenoRepo {

	protected $persona;
    protected $preinforme;
	public function __construct(Persona $persona, Preinforme $preinforme)
	{
		$this->persona = $persona;
        $this->preinforme = $preinforme;
	}
    
  

    public function poseeComputadora($campo,$valor,$inicio,$fin){

    	return $this->persona->where($campo,$valor)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }
  	

  	 public function getGenero($inicio, $fin){
        $query = $this->persona->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('genero');
        $resultado=[];
        foreach ($query as $qry => $q)
        {
                $data['nombre'] = $qry;
                $data['count'] = $q->count();
                array_push($resultado, $data);
        }
        return $resultado;
    }

    public function preInformes($inicio, $fin){
        return $this->preinforme->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin);
  
    }

    public function estadisticasNivelEstudios($inicio, $fin){

        return $this->persona->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('nivel_estudios');
    }

}