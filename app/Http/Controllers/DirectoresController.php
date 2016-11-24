<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Entities\TipoDocumento;
use App\Entities\Filial;
use App\Entities\DirectorTelfono;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevoDirectorRequest;
use App\Http\Requests\EditarDirectorRequest;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\DirectorTelefonoRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use Mail;

class DirectoresController extends Controller
{
	protected $directorRepo;

	public function __construct( DirectorRepo $directorRepo,TipoDocumento $tipoDocumentoRepo, DirectorTelefonoRepo $directorTelefonoRepo,FilialRepo $filialRepo){
		
		$this->directorRepo = $directorRepo;
		$this->tipoDocumentoRepo = $tipoDocumentoRepo;
		$this->directorTelefonoRepo = $directorTelefonoRepo;
        $this->filialRepo = $filialRepo;
	}

	public function index(){
		return view('rol_director.index');	
	}

	public function lista(){
		$directores=$this->directorRepo->allEneable();
		return view('rol_dueno.directores.lista', compact('directores'));	
	}

	public function nuevo(){
		$tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
		return view('rol_dueno.directores.nuevo', compact('tipos'));
	} 

	public function nuevo_post(CrearNuevoDirectorRequest $request){
		
        // Corroboro que el cliente exista, si exite lo activa
        $data = $request->all();
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/activarCuenta/{$request->mail}/3");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $pass = json_decode(curl_exec($ch),true);
        curl_close($ch);

     	if ($pass){
	     	if ( $director = $this->directorRepo->check($data['mail']))
            {// Datos del mail        
                $user = $request->mail;
                $nombrefull= $request->nombres . " " . $request->apellidos; 
                $datosMail = array( 'filial'    => $nombrefull, 
                            'user'      => $user, 
                            'password'  => $pass);
                // Envío del mail
                Mail::send('mailing.reactivacion_cuenta',$datosMail,function($msj) use($user){
                    $msj->subject('GeCo -- Reactivación Cuenta');
                    $msj->to($user);
                });
	        	return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido agregado con éxito');
            }
            else
                return redirect()->route('dueño.directores')->with('msg_error','El director no ha sido agregado');
		}
		if ($pass==0){ // Si no existe lo crea al director
            if ($this->directorRepo->existeMail($request->mail) || $this->filialRepo->existeMail($request->mail))
                  return redirect()->route('dueño.directores_nuevo')->with('msg_error', 'El E-Mail de la cuenta ya existe, intente con otro E-Mail.');
            else{
    	   		if($this->directorRepo->create($data)){

    				$director=$this->directorRepo->all()->last();
                    foreach ($data['telefono'] as $key) {
                        $telefono['director_id'] = $director->id;
                        $telefono['telefono'] = $key;
                        $this->directorTelefonoRepo->create($telefono);
                    }
    			  	$ch = curl_init();  
    		        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaCreate/{$request->mail}/{$director->id}/3");  
    		        curl_setopt($ch, CURLOPT_HEADER, false);  
    		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    		        $pass = json_decode(curl_exec($ch),true);
    		        curl_close($ch);

                    // Datos del mail
        			$user = $request->mail;
        			$nombrefull= $request->nombres . " " . $request->apellidos; 
            		$datosMail = array(	'filial' 	=> $nombrefull, 
            					'user' 		=> $user, 
            					'password' 	=> $pass);
    		        // Envío del mail
    		        Mail::send('mailing.cuenta',$datosMail,function($msj) use($user){
    		        	$msj->subject('GeCo -- Nueva Cuenta');
    		        	$msj->to($user);
    		        });
    	       		return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido creado con éxito.');}
    	   		else
    	    		return redirect()->route('dueño.directores')->with('msg_error','No se ha podido crear al director, intente nuevamente.');
            }
		}
	}

    public function borrar($id){

    	$cuenta=$this->directorRepo->find($id);
	 	$mail=$cuenta->mail;
       
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/borrarCuenta/{$mail}");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

       	if ($data){
       		if($this->directorRepo->disable($this->directorRepo->find($id)))
         		return redirect()->back()->with('msg_ok', 'Director eliminado correctamente.');
    		else
            	return redirect()->back()->with('msg_error','El director no ha podido ser eliminado.');}
     	else
            return redirect()->back()->with('msg_error', 'El director no ha sido encontrado o no se puede eliminar.');
    }

  	public function editar($id){
    	$director = $this->directorRepo->find($id);
    	$tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
	  	$telefono=$this->directorTelefonoRepo->findTelefono($id);
    	return view('rol_dueno.directores.editar',compact('director','tipos','telefono'));
    }

    public function editar_post(EditarDirectorRequest $request){

        $data = $request->all();
        $model = $this->directorRepo->find($data['id']);
        if($this->directorRepo->edit($model,$data)){
	      
			$model->DirectorTelefono()->delete();
			foreach ($data['telefono'] as $key) {
				$telefono['director_id'] = $model->id;
				$telefono['telefono'] = $key;
				$this->directorTelefonoRepo->create($telefono);
			}
            return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido modificado con éxito.');}
        else
            return redirect()->route('dueño.directores')->with('msg_error','El director no ha podido ser modificado.');
    }

  	public function editarPerfil($id){
    	$director = $this->directorRepo->find($id);
    	$tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
	  	$telefono=$this->directorTelefonoRepo->findTelefono($id);

    	return view('perfiles.director',compact('director','tipos','telefono'));
    }

    public function editarPerfil_post(Request $request){
        $data = $request->all();
        $model = $this->directorRepo->find($data['id']);
        if($this->directorRepo->edit($model,$data)){

			$model->DirectorTelefono()->delete();
			foreach ($data['telefono'] as $key) {

				$telefono['director_id'] = $model->id;
				$telefono['telefono'] = $key;
				$this->directorTelefonoRepo->create($telefono);
			}

	        //$this->directorTelefonoRepo->editTelefono($data['id'],$data['telefono']);
            return redirect()->back()->with('msg_ok','El perfil del director ha sido modificado con éxito.');}
        else
            return redirect()->route()->with('msg_error','El perfil del director no ha podido ser modificado.');
    }

    public function estadisticas()
    {
    	return view('rol_director.estadisticas.index');
    }

    public function estadisticas_detalles(Request $request){

    	return view('rol_director.estadisticas.detalles');
    }

}