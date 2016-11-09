<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\Recibo;
use App\Entities\ReciboTipo;
use App\Entities\ReciboConceptoPago;
use App\Entities\Pago;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevoCursoRequest;
use App\Http\Repositories\ReciboRepo;
use App\Http\Repositories\ReciboTipoRepo;
use App\Http\Repositories\ReciboConceptoPagoRepo;
use App\Http\Repositories\PagoRepo;
//use PDF;

class ReciboController extends Controller
{
	protected $pagoRepo;

	public function __construct(ReciboRepo $reciboRepo, ReciboTipoRepo $reciboTipoRepo, ReciboConceptoPagoRepo $reciboConceptoPagoRepo, PagoRepo $pagoRepo)
	{
		$this->reciboRepo 				= $reciboRepo;
		$this->reciboTipoRepo 			= $reciboTipoRepo;
		$this->reciboConceptoPagoRepo 	= $reciboConceptoPagoRepo;
		$this->pagoRepo 				= $pagoRepo;
	}

	public function lista($id){
		$pago 		= $this->pagoRepo->find($id);
		$recibos 	= $this->reciboRepo->allReciboPago($id);
		return view('rol_filial.recibos.lista',compact('pago','recibos'));
	}

	public function nuevo($id){
		$pago 		= $this->pagoRepo->find($id);
		$tipos 		= $this->reciboTipoRepo->all()->lists('recibo_tipo','id');
		$conceptos 	= $this->reciboConceptoPagoRepo->all()->lists('concepto_pago','id');
		return view('rol_filial.recibos.nuevo',compact('pago','tipos','conceptos'));
	}

	public function nuevo_post(Request $request){
		$url 					= 	session('urlBack'); session()->forget('urlBack');
		$recibo 				= 	$request->all();
		$recibo['filial_id'] 	= 	session('usuario')['entidad_id'];
		$this->reciboRepo->create($recibo);
		return redirect()->to($url);
	}

	public function imprimir($id){
		$recibo = $this->reciboRepo->find($id);
		$pdf 	= PDF::loadView('pdf.recibos', $recibo);
		// return $pdf->download('recibos.pdf');
		$pdf->download('recibos.pdf');
		return redirect()->back();
	}

	
}