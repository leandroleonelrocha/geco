<?php
namespace App\Http\Middleware;
use Closure;
use Session;
class DuenoMiddleware
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
       
        // ROL DUENO
        if($rol == 2)
            return $next($request);
        else
            return redirect()->back();
        
    
    }


}