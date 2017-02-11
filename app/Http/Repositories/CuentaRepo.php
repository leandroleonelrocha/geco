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

    public function findUser($user,$password){
    	
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

    public function deleteCuenta($id)
    {
        $cuenta = $this->model->find($id);
        $cuenta->delete();
        return Response::json(['response'=>"Cuenta borrada!"], 200);
    	
    }

        public function activarCuenta($mail,$rol)
    {
        $estado= $this->model->check($mail,$rol);

        if ($estado==1){
            $cuenta = $this->model->findUser($mail);
            $password = $this->model->generarCodigo();
            $cuenta->password   = $password;
            $cuenta->save(); 
            return Response::json($password, 200);
        }
        else{
            $password=0;
            return Response::json($password, 200);
        } 
       
    }

    public function actualizarCuenta($mail,$mailnuevo,$entidad,$rol)
    {
        $password = $this->model->generarCodigo();
        $cuenta   = $this->model->findUserActualizar($mail,$entidad,$rol);

        if ($cuenta == true) {
            $cuenta->usuario=$mailnuevo;  
            $estado   = Hash::check($password,$cuenta->password);
            $cuenta->password   = $password;
            $cuenta->save();
            return response()->json($password, 200);
        }
    }
}