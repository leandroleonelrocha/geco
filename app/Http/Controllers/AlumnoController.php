<?php

namespace App\Http\Controllers;
use Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Hash;

class AlumnoController extends Controller
{
	public function index(){
	    $ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta");  
		curl_setopt($ch, CURLOPT_HEADER, false);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$data = json_decode(curl_exec($ch),true);  
		curl_close($ch);

		return view('alumnos.index', compact('alumno', 'data'));
	}
}
