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
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\FilialTelefonoRepo;
use Mail;

class FilialesController extends Controller
{
	protected $filialesRepo;
	protected $directorRepo;

	public function __construct(FilialRepo $filialesRepo, DirectorRepo $directorRepo, FilialTelefonoRepo $filialTelefonoRepo ){

		$this->directorRepo = $directorRepo;
		$this->filialesRepo = $filialesRepo;
        $this->filialTelefonoRepo = $filialTelefonoRepo;
	}

    public function index(){
        return view('rol_filial.index');  
    }

	public function lista(){
		$filiales=$this->filialesRepo->allEneable();
		return view('rol_dueno.filiales.lista',compact('filiales'));
	}

	public function  nuevo(){
		$directores = $this->directorRepo->all()->lists('fullname','id');
		return view('rol_dueno.filiales.nuevo', compact('directores'));
	}

	public function nuevo_post(CrearNuevaFilialRequest $request){
		$this->filialesRepo->create($request->all());
		$filial=$this->filialesRepo->all()->last();

        $telefono['filial_id']=$filial->id;
        $telefono['telefono']=$request->telefono;
        $this->filialTelefonoRepo->create($telefono);
	  	$ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaCreate/{$request->mail}/{$filial->id}/4");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

        // Datos del mail
        $user = $request->mail;
        $datosMail = array(	'filial' 	=> $request->nombre, 
        					'user' 		=> $user, 
        					'password' 	=> $data);

        // Envío del mail
        Mail::send('mailing.cuenta',$datosMail,function($msj) use($user){
        	$msj->subject('GeCo -- Nueva Cuenta');
        	$msj->to($user);
        });
    
		return redirect()->route('dueño.filiales')->with('msg_ok', 'Filial creada correctamente.');
	}

    public function borrar($id){
        if($this->filialesRepo->disable($this->filialesRepo->find($id)))
            return redirect()->back()->with('msg_ok', 'Filial eliminada correctamente.');
        else
             return redirect()->back()->with('msg_error','La filial no ha podido ser eliminada.');
    }

    public function editar($id){
    	$directores = $this->directorRepo->all()->lists('fullname','id');
    	$filial = $this->filialesRepo->find($id);
        $telefono=$this->filialTelefonoRepo->findTelefono($id);
    	return view('rol_dueno.filiales.editar',compact('filial','directores','telefono'));
    }

    public function editar_post(EditarFilialRequest $request){

        $data = $request->all();
        $model = $this->filialesRepo->find($data['id']);
        if($this->filialesRepo->edit($model,$data)){
          //editar telefono
            $this->filialTelefonoRepo->editTelefono($data['id'],$data['telefono']); 
            return redirect()->route('dueño.filiales')->with('msg_ok','La filial ha sido modificada con éxito.');}
        else
            return redirect()->route('dueño.filiales')->with('msg_error','La filial no ha podido ser modificada.');
    }
}