<?php
namespace App\Http\Middleware;
use Closure;
use Session;
class FilialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   
    //$filial = session('usuario')['entidad_id'];
    public function handle($request, Closure $next)
    {
        session('usuario');
        $rol=session('usuario')['rol_id'];
       
        //ROL FILIAL
        if($rol == 4)
            return $next($request);
        else
            // session()->flush(); // Elimina todos los datos de la session
            // return redirect('login');
            return redirect()->back();
        
   
    }


}