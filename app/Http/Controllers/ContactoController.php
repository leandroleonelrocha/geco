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
use Mail;

class ContactoController extends Controller{

	protected $filialesRepo;
	protected $directorRepo;

	public function __construct(FilialRepo $filialesRepo, DirectorRepo $directorRepo, FilialTelefonoRepo $filialTelefonoRepo,DirectorTelefonoRepo $directorTelefonoRepo ){

		$this->directorRepo = $directorRepo;
		$this->filialesRepo = $filialesRepo;
        $this->filialTelefonoRepo = $filialTelefonoRepo;
      	$this->directorTelefonoRepo = $directorTelefonoRepo;

	}

	public function index(){
		$cadena=$this->filialesRepo->filialCadena();
		$filiales=$this->filialesRepo->allFilialCadena($cadena->cadena_id);
		return view('contacto',compact('filiales'));
	}	
}