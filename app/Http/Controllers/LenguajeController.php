<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Lang;
use App;
class LenguajeController extends Controller
{

	public function cambiar(Request $request)
	{
		App::setLocale($request->get('locale'));
		//Lang::setlocale($request->get('locale'));
		return redirect()->back();
	}
}
