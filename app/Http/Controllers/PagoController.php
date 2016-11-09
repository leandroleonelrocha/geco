<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\Matricula;
use App\Entities\Pago;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevoCursoRequest;
use App\Http\Repositories\MatriculaRepo;
use App\Http\Repositories\PagoRepo;

class PagoController extends Controller
{
	protected $pagoRepo;

	public function __construct(PagoRepo $pagoRepo, MatriculaRepo $matriculaRepo)
	{
		$this->pagoRepo = $pagoRepo;
		$this->matriculaRepo = $matriculaRepo;
	}

	public function vista(){
    	$matriculas = $this->matriculaRepo->allEneable();
        return view('rol_filial.pagos.vista',compact('matriculas'));
    }

	 public function lista($id){
    	$matricula  = $this->matriculaRepo->find($id);
        $pagos  = $this->pagoRepo->allMatricula($id);
        return view('rol_filial.pagos.lista',compact('matricula','pagos'));
    }

	public function nuevo($id){
		$matricula = $this->matriculaRepo->find($id);
		$url = redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
		return view('rol_filial.matriculas.pagos.nuevo',compact('matricula'));
	}

	public function nuevo_post(Request $request){
		$url 						= 	session('urlBack'); session()->forget('urlBack');
        $pago['matricula_id']   	=   $request->matricula;
        $pago['nro_pago']       	=   $request->nro_pago;
        $pago['pago_individual'] 	=  	1;
        $pago['descripcion']    	=   $request->descripcion;
        $pago['vencimiento']    	=   $request->vencimiento;
        $pago['monto_original'] 	=   $request->monto_original;
        $pago['monto_actual'] 		=   $pago['monto_original'];
        $pago['recargo']        	=   $request->recargo;
        $pago['filial_id']      	=   session('usuario')['entidad_id'];

        if ($this->pagoRepo->create($pago))
        	return redirect()->to($url)->with('msg_ok','El pago ha sido agregado con éxito.');
        else
        	return redirect()->to($url)->with('msg_error','El pago no ha podido ser agregado.');
	}

  	public function editar($id){
  		$url = redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
		$pago = $this->pagoRepo->find($id);
		return view('rol_filial.matriculas.pagos.editar',compact('pago'));
    }

    public function editar_post(Request $request){
    	$url 	= 	session('urlBack'); session()->forget('urlBack');
		$modelP = 	$this->pagoRepo->find($request->pago);
		// Venció y cambió el vencimiento
		if ( ($modelP->vencimiento < date('Y-m-d')) && ($request->vencimiento > $modelP->vencimiento) ){
			$modelP->monto_actual = $request->monto_original - $modelP->monto_pago;
			$modelP->save();
		}
		$modelP->monto_actual += $request->monto_original - $modelP->monto_original;
		$modelP->save();

		if( $this->pagoRepo->edit($modelP,$request->all()) )
			return redirect()->to($url);
		else
			return redirect()->to($url)->with('msg_error','El pago no ha podido ser modificado');
    }

    public function actualizar($id){
    	$url 	= redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
		$pago 	= $this->pagoRepo->find($id);
		return view('rol_filial.matriculas.pagos.actualizar',compact('pago'));
    }

    public function actualizar_post(Request $request){
    	$url 	= 	session('urlBack');
		$modelP = 	$this->pagoRepo->find($request->pago);
		if ($request->monto_a_pagar <= $modelP['monto_actual']){
			$pago['monto_actual'] 	= $modelP['monto_actual'] - $request->monto_a_pagar;
			$pago['monto_pago'] 	= $modelP['monto_pago'] + $request->monto_a_pagar;
			if ( $pago['monto_actual'] == 0 )
				$pago['terminado'] = 1;

			if( $this->pagoRepo->edit($modelP,$pago) )
				return redirect()->route('filial.recibo_nuevo',$modelP['id'])->with('msg_ok','El pago ha sido actualizado con éxito');
			else{
				session()->forget('urlBack');
				return redirect()->to($url)->with('msg_error','El pago no ha podido ser actualizado');
			}
		}
		else
			return redirect()->back()->with('msg_error','El monto a pagar no puede sobrepasar el monto actual.');
    }
}