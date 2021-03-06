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
use App\Http\Requests\CrearNuevoPagoRequest;
use App\Http\Requests\EditarPagoRequest;
use App\Http\Repositories\MatriculaRepo;
use App\Http\Repositories\PagoRepo;
use App\Http\Funciones\NumberToLetterConverter;
use App\Http\Repositories\ReciboRepo;
use App\Http\Repositories\ReciboTipoRepo;
use App\Http\Repositories\ReciboConceptoPagoRepo;
use PDF;
use Session;

class PagoController extends Controller
{
	protected $pagoRepo;

	public function __construct(PagoRepo $pagoRepo, MatriculaRepo $matriculaRepo, ReciboRepo $reciboRepo, ReciboTipoRepo $reciboTipoRepo, ReciboConceptoPagoRepo $reciboConceptoPagoRepo)
	{
		$this->pagoRepo                 = $pagoRepo;
		$this->matriculaRepo            = $matriculaRepo;
        $this->reciboRepo               = $reciboRepo;
        $this->reciboTipoRepo           = $reciboTipoRepo;
        $this->reciboConceptoPagoRepo   = $reciboConceptoPagoRepo;
	}

	public function vista(){

        $suma_grupo     = $this->pagoRepo->totalPorGrupo();
        //dd($suma_grupo); 

    	$matriculas = $this->matriculaRepo->allEneable();
        return view('rol_filial.pagos.vista',compact('matriculas'));
    }

	 public function lista($id){
    	$matricula  = $this->matriculaRepo->find($id);
        $pagos  = $this->pagoRepo->allMatricula($id);
        foreach ($pagos as $pago) {
        	// Obtener fecha del primer día del mes
            $month   = date('m');
            $year    = date('Y');
            // $first   = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
            // $date1   = date_create ( $first );
            // Obtengo el día nro diez de cada mes
            // $date1->modify('+9 day');
            $actualDate   = date('Y-m-d');

            $recargo = $pago->monto_original * ( $pago->recargo * 0.01);
            $montoR  = $pago->monto_original + $recargo - $pago->monto_pago;
            $montoD  = $pago->monto_original - $pago->descuento - $pago->monto_pago;
            
            if ($pago->fecha_recargo < date('Y-m-d') && $montoR != $pago->monto_actual){
                $pago->monto_actual += $recargo;
                $pago->save();
            }
            if ($actualDate <= $pago->vencimiento && $montoD != $pago->monto_actual && $pago->fecha_recargo > date('Y-m-d')) {
                $pago->monto_actual -= $pago->descuento;
                $pago->save();
            }
            if ($actualDate > $pago->vencimiento && $montoD == $pago->monto_actual && $pago->fecha_recargo > date('Y-m-d')) {
                $pago->monto_actual += $pago->descuento;
                $pago->save();
            }
        }
        return view('rol_filial.pagos.lista',compact('matricula','pagos'));
    }

	public function nuevo($id){
		$matricula = $this->matriculaRepo->find($id);
		$url = redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
		return view('rol_filial.matriculas.pagos.nuevo',compact('matricula'));
	}

	public function nuevo_post(CrearNuevoPagoRequest $request){
		$url 						= 	session('urlBack'); session()->forget('urlBack');
        $pago['matricula_id']   	=   $request->matricula;
        $pago['tipo_moneda_id']     =   session('moneda')['id'];
        $pago['nro_pago']       	=   $request->nro_pago;
        $pago['pago_individual'] 	=  	1;
        $pago['descripcion']    	=   $request->descripcion;
        $pago['vencimiento']    	=   $request->vencimiento;
        $pago['fecha_recargo']      =   $request->fecha_recargo[$i];
        $pago['monto_original'] 	=   $request->monto_original;
        $pago['monto_actual'] 		=   $pago['monto_original'];
        $pago['descuento']        	=   $request->descuento;
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

    public function editar_post(EditarPagoRequest $request){
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
    	$url 	    = redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
		$pago 	    = $this->pagoRepo->find($id);
        $tipos      = $this->reciboTipoRepo->all()->lists('recibo_tipo','id');
        $conceptos  = $this->reciboConceptoPagoRepo->all()->lists('concepto_pago','id');
		return view('rol_filial.matriculas.pagos.actualizar',compact('pago','tipos','conceptos'));
    }

    public function actualizar_post(Request $request){

        //array_push($_SESSION['pagos'], $data);
        $data   =   $request->all();
        $url 	= 	session('urlBack');
        $modelP =   $this->pagoRepo->find($request->pago);
        $ma     =   $modelP['monto_actual'] + $request->recargo_adicional;
        $map    =   (float)$request->monto_a_pagar;
        
		if ($map <= $ma){
            if (isset($request->descuento_adicional)){
                $pago['descuento_adicional'] = $request->descuento_adicional;
                $modelP['monto_actual']      -= $request->descuento_adicional;
            }
            if (isset($request->recargo_adicional)){
                $pago['recargo_adicional'] = $request->recargo_adicional;
                $modelP['monto_actual']      += $request->recargo_adicional;
            }

			$pago['monto_actual'] 	= $modelP['monto_actual'] - $request->monto_a_pagar;
			$pago['monto_pago'] 	= $modelP['monto_pago'] + $request->monto_a_pagar;
			if ( $pago['monto_actual'] == 0 )
				$pago['terminado'] = 1;

			if( $this->pagoRepo->edit($modelP,$pago) ){
                $recibo['recibo_tipo_id']           =   $request->recibo_tipo_id;
                $recibo['pago_id']                  =   $request->pago;
                $recibo['monto']                    =   $request->monto_a_pagar;
                $recibo['recibo_concepto_pago_id']  =   $request->recibo_concepto_pago_id;
                $recibo['descripcion']              =   $request->descripcion;
                $recibo['filial_id']                =   session('usuario')['entidad_id'];
                $recibo['tipo_moneda_id']           =   session('moneda')['id'];
                
                if ($this->reciboRepo->create($recibo)) {
                    
                    $id = $this->reciboRepo->all()->last()->id;
                    //return redirect()->route('filial.recibo_imprimir', $id);
                        $modelP->cuanto_pago = $request->monto_a_pagar;
                        Session::put('matricula', $modelP->Matricula);
                        $request->session()->push('pagos', $modelP);
                    // return redirect()->to($url)->with('msg_ok','El pago se agrego al carrito');
                    return redirect()->route('filial.matriculas_vista',$modelP['matricula_id'])->with('msg_ok','El pago ha sido actualizado con éxito');
                }
                // return redirect()->route('filial.recibo_nuevo',$modelP['id'])->with('msg_ok','El pago ha sido actualizado con éxito');
            }
            else{
                session()->forget('urlBack');
                return redirect()->to($url)->with('msg_error','El pago no ha podido ser actualizado');
            }
        }
        else
            return redirect()->back()->with('msg_error','El monto a pagar no puede sobrepasar el monto actual.');

        
    }


    public function tabla_morisidad(Request $request){

        $fechas  =  herlpersObtenerFechas($request->get('fecha'));
        
        $morosos =  $this->pagoRepo->allMorososEntreFechas($fechas);
        $data    =  [];   
      

        foreach ($morosos as $key => $value) {
           
            if($value->nro_pago == 0)
                $d['nro_pago']  = 'Matricula';
            else
                $d['nro_pago']  = $value->nro_pago;

            if ($value->Matricula->carrera_id != null) 
                $d['grupo'] = $value->Matricula->Carrera->nombre;
            else 
                $d['grupo'] = $value->Matricula->Curso->nombre;


            $d['vencimiento']           = helpersgetFecha($value->vencimiento);
          
            $d['saldo']                 = $value->monto_actual;
            $d['matricula']             = $value->Matricula->id;
            $d['persona']               = $value->Matricula->Persona->fullname;
            $d['fecha_pago']            = helpersgetFecha($value->created_at);
            $d['persona_email']         = $value->Matricula->Persona->PersonaMail;
            $d['persona_telefono']      = $value->Matricula->Persona->PersonaTelefono;
            
            array_push($data, $d);
        }

        $datos['fecha_desde'] = helpersgetFecha($fechas[0]);
        $datos['fecha_hasta'] = helpersgetFecha($fechas[1]);

        Session::put('morosos', $data);
        Session::put('datos', $datos);
        return response()->json($data, 200);
       

    }

    public function tabla_iva(Request $request){
        
        $fechas         =  herlpersObtenerFechas($request->get('fecha'));
        $iva            =  $this->pagoRepo->libroIvaEntreFechas($fechas);
        $suma_recibo    =  $this->pagoRepo->totalPorRecibo($fechas);
        $total_general  =  $this->pagoRepo->totalEntreFechas($fechas);
       
        //FALTA SUMA GRUPO
        $suma_grupo     = $this->pagoRepo->totalPorGrupo($fechas);
        //dd($suma_grupo);

        $data    =  [];   
      

        foreach ($iva as $key => $value) {
            

            $d['fecha']        = helpersgetFecha($value->created_at);
            $d['recibo']       = $value->ReciboTipo->recibo_tipo;
            $d['importe']      = $value->monto;
            $d['nombre']       = $value->Pago->Matricula->Persona->fullname;
       
            array_push($data, $d);
        }

       

        $datos['fecha_desde'] = helpersgetFecha($fechas[0]);
        $datos['fecha_hasta'] = helpersgetFecha($fechas[1]);

        Session::put('libro_iva', $data);
        Session::put('datos', $datos);
        Session::put('suma_recibo', $suma_recibo);
        Session::put('total_general', $total_general);
        Session::put('suma_grupo',$suma_grupo);
        
        return response()->json($data, 200);
       
        
    }


    public function imprimir_morosidad(){
       
       $model = Session::get('morosos');
       $datos = Session::get('datos');
       $pdf   = PDF::loadView('impresiones.impresion_morosidad',compact('model','datos'));
       return $pdf->stream();

    }

    public function imprimir_iva(){

       $model           = Session::get('libro_iva');
       $datos           = Session::get('datos');
       $suma_recibo     = Session::get('suma_recibo');
       $total_general   = Session::get('total_general');
       $suma_grupo      = Session::get('suma_grupo');
       $pdf   = PDF::loadView('impresiones.impresion_libro_IVA',compact('model','datos','suma_recibo','total_general','suma_grupo'));
       return $pdf->stream();
    }

    public function nuevo_plan($id){
        $matricula = $this->matriculaRepo->find($id);
        $url = redirect()->back()->getTargetUrl(); session(['urlBack' => $url]);
        return view('rol_filial.matriculas.pagos.nuevo_plan',compact('matricula'));
    }

    public function nuevo_plan_post(Request $request){
        $url                        =   session('urlBack'); session()->forget('urlBack');
        for ($i = 0; $i < count($request->nro_pago); $i++) {
            $pago['matricula_id']       =   $request->matricula;
            $pago['tipo_moneda_id']     =   session('moneda')['id'];
            $pago['nro_pago']           =   $request->nro_pago[$i];
            $pago['descripcion']        =   $request->descripcion[$i];
            $pago['vencimiento']        =   $request->vencimiento[$i];
            $pago['fecha_recargo']      =   $request->fecha_recargo[$i];
            $pago['monto_original']     =   $request->monto_original[$i];
            $pago['monto_actual']       =   $pago['monto_original'];
            $pago['descuento']          =   $request->descuento[$i];
            $pago['recargo']            =   $request->recargo[$i];
            $pago['filial_id']          =   session('usuario')['entidad_id'];

            $this->pagoRepo->create($pago);
        }
            return redirect()->to($url);
    }

    public function borrar($id){
        $pago = $this->pagoRepo->find($id);
        $pago->delete();
        return redirect()->back();
    }

    public function carrito(){
        return view('rol_filial.matriculas.partials.carrito');
    }

    public function vista_libro_iva(){
        return view('rol_filial.pagos.vista');
    }

   
}