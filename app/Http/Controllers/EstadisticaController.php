<?php

namespace App\Http\Controllers;
use Controllers;
use App\Http\Repositories\PagoRepo;


class EstadisticaController extends Controller
{
	public function __construct(PagoRepo $pagoRepo)
	{
		$this->pagoRepo = $pagoRepo;

	}

	public function index(){
	  
	  $pagos = $this->pagoRepo->all();
	  $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


	  
	  return view('rol_director.estadisticas.index', compact('pagos', 'months'));
	}
	//["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
	//Estadisticas de pago
	//



}
