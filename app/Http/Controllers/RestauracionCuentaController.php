<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\User;
use Auth;
use App\Entities\Cuenta;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Repositories\CuentaRepo;
use Mail;

class RestauracionCuentaController extends Controller {

  	public function __construct(CuentaRepo $cuentaRepo){

	    $this->cuentaRepo  = $cuentaRepo;
  	}

	public function nueva()
	{
	    return view('restablecer_cuenta');
	}


    public function post_Nueva(Request $request)
    {

        // $ch = curl_init();  
        // curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/restaurarCuenta/{$request->mail}");  
        // curl_setopt($ch, CURLOPT_HEADER, false);  
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        // $data = json_decode(curl_exec($ch),true);
        // curl_close($ch);

    	$usuario  = $request->mail;
        $pass = $this->cuentaRepo->restaurarCuenta($usuario);
        					
  		if ($pass){
			// Datos del mail
        	$datosMail = array(	'user' 		=> $usuario, 
        					'password' 	=> $pass);
       
	        // Envío del mail
	        Mail::send('mailing.restauracion_cuenta',$datosMail,function($msj) use($usuario){
	        	$msj->subject('GeCo -- Restauración de Cuenta del usuario');
	        	$msj->to($usuario);
	        });

	    	return redirect()->route('restaurarCuenta.nueva')->with('msg_ok', 'Cuenta restablecida correctamente !!!.');
	    }
	    else{

    		return redirect()->route('restaurarCuenta.nueva')->with('msg_error', 'El E-mail no existe o no esta activo, escriba otro !!!');
	    }
    }
}