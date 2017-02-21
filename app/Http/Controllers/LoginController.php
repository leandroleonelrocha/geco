<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Cuenta;

use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\CuentaRepo;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use PDF;
use Hash;

class LoginController extends Controller {

  public function __construct(FilialRepo $filialeRepo, CuentaRepo $cuentaRepo){
    $this->filialeRepo = $filialeRepo;
    $this->cuentaRepo  = $cuentaRepo;
  }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request){
        
        $usuario  = $request->usuario;
        $password = $request->password;
        $cuenta   = Cuenta::where('usuario',$usuario)->where('activo',1)->first();
        
        if($cuenta == true)
        {
            $estado   = Hash::check($password, $cuenta->contrasena);

            if($estado== true){
              $data['id']          = $cuenta['id'];
              $data['usuario']     = $cuenta['usuario'];
              $data['password']    = $cuenta['password'];
              $data['rol_id']      = $cuenta['rol_id'];
              $data['entidad_id']  = $cuenta['entidad_id'];
              $data['habilitado']  = $cuenta['habilitado'];

              session(['usuario' => $data]);

              switch ($data['rol_id']) {
               
                case 2: // Rol de Dueño
                  return redirect()->route('dueño.inicio');
                break;
                case 3: // Rol de Director
                  return redirect()->route('director.inicio');
                break;
                case 4: // Rol de Filial
                  $filial =  $this->filialeRepo->find(session('usuario')['id']);
                  $tipo_moneda = $filial->Pais->TipoMoneda;
                  $leng=$filial->Pais->lenguaje;
                  session(['moneda' => $tipo_moneda]);
                  session(['lang' => $leng]);
                  return redirect()->route('filial.inicio');
                break;
              }
            }
            else 
               return redirect()->back()->with('msg_error', 'La combinación de Usuario y Contraseña son incorrectos.'); 
          }
          else 
               return redirect()->back()->with('msg_error', 'Usuario no válido para ingresar.');
       

        // $ch = curl_init();  
        // curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaLogin/{$request->usuario}/{$request->password}");  
        // curl_setopt($ch, CURLOPT_HEADER, false);  
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        // $data = json_decode(curl_exec($ch),true);
        // curl_close($ch);
         


        //Rol 2 Dueño
        //Rol 3 Director
        //Rol 4 Filial
      
        /*
        $cuentas = array(
                     array(
                    'id'          => 1,
                     'usuario'     => 'ferrari@administrador.com',
                     'password'    => 1234,
                    'rol_id'      => 2,
                     'entidad_id'  => 1,
                     'habilitado'  => 1 
                     ),
                     array(
                     'id'          => 2,
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
                    'habilitado'  => 1,
                     ),
                     array(
                     'id'          => 1,
                     'usuario'     => 'filial2@filial.com',
                     'password'    => 1234,
                     'rol_id'      => 4,
                     'entidad_id'  => 1,
                     'habilitado'  => 1 
                     ),
                    array(
                     'id'          => 2,
                     'usuario'     => 'filial3@filial.com',
                     'password'    => 1234,
                     'rol_id'      => 4,
                     'entidad_id'  => 2,
                     'habilitado'  => 0 
                     )
                   );

        foreach ($cuentas as $cuenta) {
          if ($request->usuario == $cuenta['usuario'] && $request->password == $cuenta['password']) {
            $data['id']          = $cuenta['id'];
            $data['usuario']     = $cuenta['usuario'];
            $data['password']    = $cuenta['password'];
            $data['rol_id']      = $cuenta['rol_id'];
            $data['entidad_id']  = $cuenta['entidad_id'];
            $data['habilitado']  = $cuenta['habilitado'];
            break;
          }
          else
           $data = null;
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
            $filial =  $this->filialeRepo->find(session('usuario')['id']);
            $tipo_moneda = $filial->Pais->TipoMoneda;
            session(['moneda' => $tipo_moneda]);
            return redirect()->route('filial.inicio');
          break;
        }
      }
      else
        return redirect()->back()->with('msg_error', 'La combinación de Usuario Y Contraseña son incorrectos.');
    */
    }
    
    // login local
    public function getLogout()
    {
        // Auth::logout();
        session()->flush(); // Elimina todos los datos de la session
        return redirect('login');
    }

    public function nueva()//contraseña
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

    public function post_Nueva(Request $request)//cambio de contraseña
    {

      if (null !== session('usuario')){
        $rol = session('usuario')['rol_id'];
        if ( $rol== 4 || $rol==3 || $rol==2){

          $user=$request->all();
            
          $mail   = session('usuario')['usuario'];
          $cuenta = Cuenta::where('usuario',$mail)->first();
          
          $estado   = Hash::check($user['passwordActual'],$cuenta->contrasena);

          if ($estado == true) {

            if ($user['passwordr'] == $user['contrasena']){

              $this->cuentaRepo->edit($cuenta, $user);
              return redirect()->route('contrasena.nueva')->with('msg_ok', 'Cambio de contraseña correctamente.');
            }
            else
            /*
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/actualizarpassword/{$mail}/{$request->password}/{$request->passwordActual}");  
            curl_setopt($ch, CURLOPT_HEADER, false);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $data = json_decode(curl_exec($ch),true);
            curl_close($ch);
            */
              return redirect()->route('contrasena.nueva')->with('msg_error', 'Las contraseñas no son iguales, reingrese nuevamente las contraseñas');
          }
          else
            return redirect()->route('contrasena.nueva')->with('msg_error', 'La contraseña anterior es incorrecta.');
        }
        else
          return redirect()->back();
      }
     else
        session()->flush(); // Elimina todos los datos de la session
        return redirect('login');  
    }
}