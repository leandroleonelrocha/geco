<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller {

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request){
        /*
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaLogin/{$request->usuario}/{$request->password}");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);
        */  

       $cuentas = array(
                    array(
                    'id'          => 1,
                    'usuario'     => 'ferrari@dueño.com',
                    'password'    => 1234,
                    'rol_id'      => 2,
                    'entidad_id'  => 1,
                    'habilitado'  => 1 
                    ),
                    array(
                    'id'          => 1,
                    'usuario'     => 'director@director.com',
                    'password'    => 1234,
                    'rol_id'      => 3,
                    'entidad_id'  => 1,
                    'habilitado'  => 1 
                    ),
                    array(
                    'id'          => 3,
                    'usuario'     => 'filial@filial.com',
                    'password'    => 1234,
                    'rol_id'      => 4,
                    'entidad_id'  => 3,
                    'habilitado'  => 0 
                    )
                  );

       foreach ($cuentas as $cuenta) {
         if ($request->usuario == $cuenta['usuario']) {
           $data['id']          = $cuenta['id'];
           $data['usuario']     = $cuenta['usuario'];
           $data['password']    = $cuenta['password'];
           $data['rol_id']      = $cuenta['rol_id'];
           $data['entidad_id']  = $cuenta['entidad_id'];
           $data['habilitado']  = $cuenta['habilitado'];
         }
       }

      if ($data){
        session(['usuario' => $data]);
        switch ($data['rol_id']) {
          case 2: // Rol de Dueño
            return redirect()->route('dueño.inicio');
          break;
          case 3: // Rol de Director
            return redirect()->route('director.inicio');
          break;
          case 4: // Rol de Filial
            return redirect()->route('filial.inicio');
          break;
        }
      }
      else
        return redirect()->back()->with('msg_error', 'La combinación de Usuario Y Contraseña son incorrectos.');
    }
    
    // login local
    public function getLogout()
    {
        // Auth::logout();
        session()->flush(); // Elimina todos los datos de la session
        return redirect('login');
    }

    public function nueva()
    {
      if (null !== session('usuario')){
        $rol=session('usuario')['rol_id'];
        if ( $rol== 4 || $rol==3 || $rol==2){
          $mail=session('usuario')['usuario'];

          return view('cambio_contrasena',compact('mail','data'));
        }
        else
          return redirect()->back();
      }
      else
        return redirect('login');  
    }

    public function post_Nueva(Request $request){
      if (null !== session('usuario')){
        $rol = session('usuario')['rol_id'];
        if ( $rol== 4 || $rol==3 || $rol==2){

          $user=$request->all();
      
          if ($user['passwordr']==$user['password']){

            $mail=session('usuario')['usuario'];

            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/actualizarCuenta/{$mail}/{$request->password}/{$request->passwordActual}");  
            curl_setopt($ch, CURLOPT_HEADER, false);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $data = json_decode(curl_exec($ch),true);
            curl_close($ch);

            if ($data) 
              return redirect()->route('contrasena.nueva')->with('msg_ok', 'Cambio de contraseña correctamente.');
            else

              return redirect()->route('contrasena.nueva')->with('msg_error', 'La combinación de E-Mail y Contraseña son incorrectos.');
          }
          else
            return redirect()->route('contrasena.nueva')->with('msg_error', 'Las contraseñas no son iguales, reingrese nuevamente las contraseñas');
        }
        else
          return redirect()->back();
      }
     else
        return redirect('login');  
    }
}