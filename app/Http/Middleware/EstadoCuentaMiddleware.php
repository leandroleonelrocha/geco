<?php
namespace App\Http\Middleware;
use Closure;
use Session;
class EstadoCuentaMiddleware
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
        $estado=session('usuario')['habilitado'];
       	$habilitado = 1;
        //ROL FILIAL
        if($estado == $habilitado)
            return $next($request);
        else
            // session()->flush(); // Elimina todos los datos de la session
            // return redirect('login');
            return redirect()->back()->with('estado_cuenta', 'Su cuenta no esta habilitada para utilizar nuestros servicio');

        
   
    }


}