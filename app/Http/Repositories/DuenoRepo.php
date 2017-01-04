<?php
namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Entities\Preinforme;
use App\Entities\Pago;
use DB;

use Illuminate\Support\Facades\Auth;


class DuenoRepo {

	protected $persona;
    protected $preinforme;
    protected $pago;

	public function __construct(Persona $persona, Preinforme $preinforme, Pago $pago)
	{
		$this->persona    = $persona;
        $this->preinforme = $preinforme;
        $this->pago       = $pago;
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

    public function estadisticasRecaudacion($inicio, $fin){
        return $this->pago->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->groupBy('filial_id');

    }

    public function estadisticasMorosidad($inicio, $fin){
        $fecha_hoy   = date("Y-m-d H:i:s");
        $qry         = DB::table('pago')
                   ->join('filial', 'pago.filial_id', '=', 'filial.id')
                   ->select(DB::raw('SUM(monto_actual) as total'))
                   ->whereDate('pago.created_at','>=',$inicio)
                   ->whereDate('pago.created_at','<=',$fin)
                   ->where('vencimiento', '>', $fecha_hoy)
                   ->where('terminado',0)
                   ->groupBy('filial_id')
                   ->get();
         dd($qry);          

       //return $this->pago->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('vencimiento', '>', $fecha_hoy)->where('terminado',0)->get()->groupBy('filial_id');
    }

}