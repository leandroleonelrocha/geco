<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\User;
use Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Mail;

class RestauracionCuentaController extends Controller {

	public function nueva()
	{
	    return view('restablecer_cuenta');
	}


    public function post_Nueva(Request $request)
    {

        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/restaurarCuenta/{$request->mail}");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);
        					
  		if ($data) {
			// Datos del mail
	        $user = $request->mail;
        	$datosMail = array(	'user' 		=> $user, 
        					'password' 	=> $data);
       
	        // Envío del mail
	        Mail::send('mailing.restauracion_cuenta',$datosMail,function($msj) use($user){
	        	$msj->subject('GeCo -- Restauración de Cuenta del usuario');
	        	$msj->to($user);
	        });

	    	return redirect()->route('restaurarCuenta.nueva')->with('msg_ok', 'Cuenta restablecida correctamente !!!.');
	    }
	    else{

    		return redirect()->route('restaurarCuenta.nueva')->with('msg_error', 'El E-mail no existe, escriba otro !!!');

	    }
    }
}