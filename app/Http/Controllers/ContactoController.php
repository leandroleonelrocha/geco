<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\DirectorTelefonoRepo;
use App\Http\Repositories\FilialTelefonoRepo;
use App\Entities\FilialTelefono;

class ContactoController extends Controller{

	protected $filialesRepo;
	protected $directorRepo;

	public function __construct(FilialRepo $filialesRepo, DirectorRepo $directorRepo, FilialTelefonoRepo $filialTelefonoRepo,DirectorTelefonoRepo $directorTelefonoRepo ){

		$this->directorRepo = $directorRepo;
		$this->filialesRepo = $filialesRepo;
        $this->filialTelefonoRepo = $filialTelefonoRepo;
      	$this->directorTelefonoRepo = $directorTelefonoRepo;

	}

	public function index()
	{
  		if (null !== session('usuario')){
        	if (session('usuario')['rol_id'] == 4){
				$cadena=$this->filialesRepo->filialCadena();
				$filiales=$this->filialesRepo->allFilialCadena($cadena->cadena_id);
				return view('contacto',compact('filiales'));
			}

	     	if (session('usuario')['rol_id'] == 3 ){
				$filiales=$this->filialesRepo->allFilialDirector();
				return view('contacto',compact('filiales'));
			}

			if (session('usuario')['rol_id'] == 2){

				$entidad=session('usuario')['entidad_id'];
				$ch = curl_init();  
				curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/obtenerCadena/{$entidad}");  
				curl_setopt($ch, CURLOPT_HEADER, false);  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
				$cadena = json_decode(curl_exec($ch),true);
				// var_dump($cadena);die;
				curl_close($ch);

				foreach ($cadena as $c) {
					$filiales=$this->filialesRepo->allFilialCadena($c);
				}
		 		return view('contacto',compact('filiales'));
		 	}
		} 
	}	
}