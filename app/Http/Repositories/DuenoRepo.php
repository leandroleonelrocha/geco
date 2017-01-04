<?php
namespace App\Http\Repositories;
use App\Entities\Persona;
use App\Entities\Preinforme;
use App\Entities\Pago;
use App\Entities\Examen;
use DB;

use Illuminate\Support\Facades\Auth;


class DuenoRepo {

	protected $persona;
    protected $preinforme;
    protected $pago;
    protected $examen;

	public function __construct(Persona $persona, Preinforme $preinforme, Pago $pago, Examen $examen)
	{
		$this->persona    = $persona;
        $this->preinforme = $preinforme;
        $this->pago       = $pago;
        $this->examen     = $examen;
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
        $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('terminado',1)
                         ->groupBy('filial_id')
                         ->get();
        return $qry;      

    }

    public function estadisticasMorosidad($inicio, $fin){
        $fecha_hoy   = date("Y-m-d H:i:s");
        $qry         = DB::table('pago')
                         ->join('filial', 'pago.filial_id', '=', 'filial.id')
                         ->select(DB::raw('SUM(monto_actual) as total, filial.nombre'))
                         ->whereDate('pago.created_at','>=',$inicio)
                         ->whereDate('pago.created_at','<=',$fin)
                         ->where('vencimiento', '>', $fecha_hoy)
                         ->where('terminado',0)
                         ->groupBy('filial_id')
                         ->get();
        return $qry;      

    }

    public function montoTotalMorosidad($inicio, $fin){
        $fecha_hoy   = date("Y-m-d H:i:s");
        return $this->pago->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('vencimiento', '>', $fecha_hoy)->where('terminado',0)->sum('monto_actual');
    }

    public function montoTotalRecaudacion($inicio, $fin){
         return $this->pago->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->where('terminado',1)->sum('monto_actual');
    }

    public function estadisticasExamen($inicio, $fin){
         $qry         = DB::table('examen')
                         ->join('grupo', 'examen.grupo_id', '=', 'grupo.id')
                         ->select(DB::raw('AVG(nota) as promedio', 'grupo.descripcion'))
                         ->groupBy('nro_acta')
                         ->get();
        return $qry;   
    }

}