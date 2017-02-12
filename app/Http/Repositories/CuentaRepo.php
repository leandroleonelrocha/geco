<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 19/04/2016
 * Time: 11:33
 */

namespace App\Http\Repositories;
use App\Entities\Cuenta;
use Hash;
use Response;
use Illuminate\Http\Request;

class CuentaRepo extends BaseRepo
{

    public function getModel()
    {
        return new Cuenta();
    }

    

    public function postLogin(Request $request){
        return redirect()->route('administracion.cuentas_lista');
    }

    public function cuentas_lista(){
        $cuentas = $this->cuentaRepo->allCuentas();
        return view('administracion.cuentas.lista', compact('cuentas'));
    }

    public function habilitar($id){
        $cuenta = $this->cuentaRepo->find($id);
        if($cuenta->habilitado == 1){
            $cuenta->habilitado = 0;
            $resultado = '<i class="btn btn-red fa fa-thumbs-o-down" title="Inhabilitado"></i>';
        }
        else
        {
            $cuenta->habilitado = 1;
            $resultado = '<i class="btn btn-green fa fa-thumbs-o-up" title="Habilitado"></i>';
        }

        if ($cuenta->save())
            return Response::json($resultado,200);
    }





    public function findUser($user){
        return $this->model->where('usuario',$user)->first();
	}

	function generarCodigo(){
		$patron = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$codigo = '';
		for($i=0;$i<12;$i++) {
			// Devuelve parte de una cadena
			$codigo .= substr($patron,rand(1,62),1);
		}
		return $codigo;
	}

	 public function allCuenta()
    {   
        
        $cuentas = $this->model->all();
        return Response::json($cuentas,200);
    }

    public function getCuenta($id)
    {
    	$cuenta = $this->model->find($id);
        $resultado['results'] = [];
        if(is_null($cuenta)){
            return false;
        }
        $resultado['results'] = $cuenta;
        $resultado['results']['rol'] = $cuenta->Rol;
        return response()->json($resultado, 200);
    }

    public function getCuentaLogin($usuario, $password){

        //$cuenta = Cuenta::where('usuario',$usuario)->first();
        $cuenta = $this->model->findUser($usuario, $password);
        $estado = Hash::check($password, $cuenta->password);
        
        if(count($cuenta) >0)
        
        {
            if($estado == TRUE)
            {
                return response()->json($cuenta, 200);
            }else{
               return Response::json(['response'=>"Cuenta no encontrada!"], 400);
            }

        }else{
            return Response::json(['response'=>"Cuenta no encontrada!"], 400);

        }

        //$cuenta = $this->cuentaRepo->findUser($usuario, $password));
        //return response()->json($cuenta, 200);
    }

    public function createCuenta($usuario,$entidad,$rol){
        $contrasena = $this->generarCodigo();
        $cuenta = array('usuario' => $usuario, 'contrasena' => $contrasena, 'rol_id' => $rol, 'entidad_id' => $entidad);
        $this->model->create($cuenta);
        return $contrasena;
    }

    public function saveCuenta()
    {
    	$cuenta = $this->model->find($id);
        if(is_null($cuenta))
        {
            return Response::json(['response'=>"Cuenta no encontrada!"], 400);
        }
            return Response::json($cuenta,200);
    }
  
    public function updateCuenta(Request $request, $id)
    {
        $cuenta = $this->model->find($id);
        $datos = $request->all();    
        if(is_null($cuenta)){
            return Response::json(['response'=>"La Cuenta no pudo ser actualizada!"], 400);
        }
        $cuenta->edit($cuenta, $datos);
        return Response::json(['response'=>"Cuenta actualizada!"], 200);
    }

    public function deleteCuenta($id)//borrado fisico
    {
        $cuenta = $this->model->find($id);
        $cuenta->delete();
        return Response::json(['response'=>"Cuenta borrada!"], 200);
    }

    public function borrarCuenta($mail)
    {
        $cuenta = $this->findUser($mail);
        $cuenta->activo = 0;
        $cuenta->save();    
        return $cuenta;   
    }


    public function activarCuenta($mail,$rol)
    {

        $cuenta = Cuenta::where('usuario',$mail)->where('rol_id',$rol)->where('activo',0)->first();
     
        if (count($cuenta) > 0){
            $password = $this->generarCodigo();
            $cuenta->activo     = 1;
            $cuenta->contrasena   = $password;
            $cuenta->save(); 
            return $password;
        }
        else{

            $password=0;
            return $password;
        } 
       
    }

    public function restaurarCuenta($mail)
    {
        $cuenta   = Cuenta::where('usuario',$mail)->where('activo',1)->first();
                            
        if ($cuenta) {
            $password = $this->generarCodigo();
            $cuenta->contrasena  = $password;
            $cuenta->save();
            return $password;
        }
    }

    public function actualizarCuenta($mail,$mailnuevo,$entidad,$rol)
    {
        $password = $this->generarCodigo();
        $cuenta   = $this->findUserActualizar($mail,$entidad,$rol);

        if ($cuenta == true) {
            $cuenta->usuario=$mailnuevo;  
            $estado   = Hash::check($password,$cuenta->contrasena);
            $cuenta->contrasena  = $password;
            $cuenta->save();
            return $password;
        }
    }

    public function findUserActualizar($user,$entidad,$rol){
        return $this->model->where('usuario',$user)->where('activo',1)->where('entidad_id',$entidad)->where('rol_id',$rol)->first();
    }
}