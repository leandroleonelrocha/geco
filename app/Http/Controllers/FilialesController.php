<?php

namespace App\Http\Controllers;
use Controllers;
use App\Entities\NombreDirector;
use App\Entities\FilialTelefono;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevaFilialRequest;
use App\Http\Requests\EditarFilialRequest;
use App\Http\Requests\EditarPerfilFilialRequest;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\FilialTelefonoRepo;
use App\Http\Repositories\CadenaRepo;
use Mail;

class FilialesController extends Controller
{
	protected $filialesRepo;
	protected $directorRepo;

	public function __construct(FilialRepo $filialesRepo, DirectorRepo $directorRepo, FilialTelefonoRepo $filialTelefonoRepo, CadenaRepo $cadenaRepo){

		$this->directorRepo       = $directorRepo;
		$this->filialesRepo       = $filialesRepo;
        $this->filialTelefonoRepo = $filialTelefonoRepo;
        $this->cadenaRepo         = $cadenaRepo;
	}

    public function index(){
        return view('rol_filial.index');  
    }

	public function lista(){
		$filiales = $this->filialesRepo->allEneable();
		return view('rol_dueno.filiales.lista',compact('filiales'));
	}

	public function  nuevo(){
		$directores = $this->directorRepo->all()->lists('fullname','id');
        $cadenas    = $this->cadenaRepo->all()->lists('nombre','id');
		return view('rol_dueno.filiales.nuevo', compact('directores', 'cadenas'));
	}

	public function nuevo_post(CrearNuevaFilialRequest $request){
		
        // Corroboro que el cliente exista, si existe lo activa
        $data = $request->all();
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/activarCuenta/{$request->mail}/4");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $pass = json_decode(curl_exec($ch),true);
        curl_close($ch);

        if ($pass){
            if ( $this->filialesRepo->check($data['mail'])){
                // Datos del mail
                $user = $request->mail;
                $datosMail = array( 'filial'    => $request->nombre, 
                                    'user'      => $user, 
                                    'password'  => $pass);
                // Envío del mail reactivacion
                Mail::send('mailing.reactivacion_cuenta',$datosMail,function($msj) use($user){
                    $msj->subject('GeCo -- Reactivación de Cuenta');
                    $msj->to($user);
                }); 
                return redirect()->route('dueño.filiales')->with('msg_ok', 'La Filial ha sido agregada con éxito.');}
            else
                return redirect()->route('dueño.filiales')->with('msg_error', 'La Filial no ha sido agregada.');
        }
         // Si no existe lo crea a la filial
        if ($pass==0) {

            if ($this->filialesRepo->existeMail($request->mail) || $this->directorRepo->existeMail($request->mail))
                  return redirect()->route('dueño.filiales_nuevo')->with('msg_error', 'El E-Mail de la cuenta ya existe, intente con otro E-Mail.');
            else{
                $this->filialesRepo->create($data);
                $filial = $this->filialesRepo->all()->last();

                foreach ($data['telefono'] as $key) {                     
                    $telefono['filial_id'] = $filial->id;
                    $telefono['telefono'] = $key;
                    $this->filialTelefonoRepo->create($telefono);
                }
        	  	$ch = curl_init();  
                curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaCreate/{$request->mail}/{$filial->id}/4");  
                curl_setopt($ch, CURLOPT_HEADER, false);  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
                $pass = json_decode(curl_exec($ch),true);
                curl_close($ch);

                // Datos del mail
                $user = $request->mail;
                $datosMail = array(	'filial' 	=> $request->nombre, 
                					'user' 		=> $user, 
                					'password' 	=> $pass);
                // Envío del mail nuevo
                Mail::send('mailing.cuenta',$datosMail,function($msj) use($user){
                	$msj->subject('GeCo -- Nueva Cuenta');
                	$msj->to($user);
                }); 
                return redirect()->route('dueño.filiales')->with('msg_ok', 'Filial creada correctamente.');
            }
        }
	}

    public function borrar($id){

        $cuenta=$this->filialesRepo->find($id);
        $mail=$cuenta['mail'];
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/borrarCuenta/{$mail}");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

        if ($data){
            if($this->filialesRepo->disable($cuenta))

                return redirect()->back()->with('msg_ok', 'Filial eliminada correctamente.');
            else
                return redirect()->back()->with('msg_error','La filial no ha podido ser eliminada.');}
        else
            return redirect()->back()->with('msg_error', 'La Filial no ha sido encontrada o no se puede eliminar.');
    } 

    public function editar($id){

    	$directores = $this->directorRepo->all()->lists('fullname','id');
        $cadenas    = $this->cadenaRepo->all()->lists('nombre','id');
    	$filial = $this->filialesRepo->find($id);
        $telefono=$this->filialTelefonoRepo->findTelefono($id);
    	return view('rol_dueno.filiales.editar',compact('filial','directores','telefono','cadenas'));
    }

    public function editar_post(EditarFilialRequest $request){

        $data = $request->all();
        $model = $this->filialesRepo->find($data['id']);
        if($this->filialesRepo->edit($model,$data)){
           //editar telefono
            $model->FilialTelefono()->delete();
            foreach ($data['telefono'] as $key) {
                $telefono['filial_id'] = $model->id;
                $telefono['telefono'] = $key;
                $this->filialTelefonoRepo->create($telefono);
            }
            return redirect()->route('dueño.filiales')->with('msg_ok','La filial ha sido modificada con éxito.');}
        else
            return redirect()->route('dueño.filiales')->with('msg_error','La filial no ha podido ser modificada.');
    }

    public function editarPerfil($id){
        $filial = $this->filialesRepo->find($id);
        $cadenas    = $this->cadenaRepo->all()->lists('nombre','id');
        $telefono=$this->filialTelefonoRepo->findTelefono($id);
        return view('perfiles.filial',compact('filial','telefono','cadenas'));
    }

    public function editarPerfil_post(EditarPerfilFilialRequest $request){

        $data = $request->all();
        $model = $this->filialesRepo->find($data['id']);
        if($this->filialesRepo->edit($model,$data)){
          //editar telefono
            $model->FilialTelefono()->delete();
            foreach ($data['telefono'] as $key) {
                $telefono['filial_id'] = $model->id;
                $telefono['telefono'] = $key;
                $this->filialTelefonoRepo->create($telefono);
            }
            return redirect()->back()->with('msg_ok','El perfil de la filial ha sido modificada con éxito.');}
        else
            return redirect()->back()->with('msg_error','El perfil de la filial no ha podido ser modificado.');
    }
}