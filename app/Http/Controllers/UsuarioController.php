<?php

namespace App\Http\Controllers;
use Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Hash;
use App\Entities\User;
use App\Http\Repositories\UserRepo;


class UsuarioController extends Controller
{
	protected $usuarioRepo;


	public function __construct(UserRepo $usuarioRepo)
	{
		$this->usuarioRepo = $usuarioRepo;
	}
	

	public function index()
	{
		dd($this->usuarioRepo->all());

		return view('usuarios.index');
	
	}

	public function nuevo()
	{
		return view('usuarios.create');
	}


	public function postNuevo(Request $request)
	{
		User::create($request->all());
		return redirect()->route('auth.login')->with('msg_ok', 'Usuario creado correctamente');

	}

}
