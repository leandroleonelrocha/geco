<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\CrearNuevoContactoRequest;
use Mail;

class ContactoController extends Controller{

	public function index(){
		if (null !== session('usuario')){
			if (session('usuario')['rol_id'] == 4){
				return view('contacto');
			}
		    else
		        return redirect()->back();
		    }
		else
		    return redirect('login');
	}	

	public function nuevo_post(CrearNuevoContactoRequest $request){
		
	    // Datos del mail
		$nombre= $request->nombre;
		$tipoConsulta=$request->tipoConsulta;
		$mail = $request->mail;
		$telefono= $request->telefono;
		$mensaje= $request->mensaje;

		$datosMail = array(	'nombre' 	=> $nombre, 
					'tipoConsulta' 		=> $tipoConsulta, 
					'mail' 		=> $mail, 
					'telefono' 	=> $telefono,
					'mensaje' 	=> $mensaje,

					);
		$user="crisdabruno@hotmail.com";

	    // Envío del mail
	    Mail::send('mailing.contacto',$datosMail,function($msj) use($user){
	    	$msj->subject('GeCo -- Consulta');
	    	$msj->to($user);
	    });

     	return redirect()->back()->with('msg_ok','Datos enviados correctamente.');
	}
}