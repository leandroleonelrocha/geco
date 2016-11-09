<?php
namespace App\Http\Controllers;
use App\Entities\Asesor;
use App\Entities\TipoDocumento;
use App\Entities\AsesorFilial;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\AsesorFilialRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
class AsignacionAsesorAFilialController extends Controller {

	protected $asesorRepo;
	
    public function __construct(AsesorRepo $asesorRepo, TipoDocumento $tipoDocumentoRepo,AsesorFilialRepo $asesorFilialRepo)
	{
		$this->asesorRepo        = $asesorRepo;
		$this->tipoDocumentoRepo  = $tipoDocumentoRepo;
        $this->asesorFilialRepo  = $asesorFilialRepo;
	}

    public function lista(){

        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
                $asesor = $this->asesorFilialRepo->allAsesorFilial(); // Obtención de todos los Acesores activos de la filial 
             
                return view('rol_filial.asesores.asignacion.lista',compact('asesor'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function nuevo(){

    if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
                $asesor = $this->asesorRepo->allEneable(); // Obtención de todos los Acesores activos no importa de la filial qeu sean
                return view('rol_filial.asesores.asignacion.nuevo',compact('asesor'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function nuevo_post($id){

        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
              

                $f = session('usuario')['entidad_id'];
                $asesorFilial['asesor_id']=$id;
                $asesorFilial['filial_id']=$f;

                if($this->asesorFilialRepo->create($asesorFilial))

                    return redirect()->route('filial.asignacionAsesores')->with('msg_ok','Se ha asignado el asesor a la filial.');
                else
                    return redirect()->route('filial.asignacionAsesores')->with('msg_error','No se ha podido asignar e asesor a la flial.');
                
            }
            else
                return redirect()->back();          
        }
        else
            return redirect('login');

    }

    public function borrar($id){

        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){

                if ( $this->asesorFilialRepo->deleteAsesor($id))
                    return redirect()->route('filial.asignacionAsesores')->with('msg_ok','Asesor eliminado correctamente de la filial.');
                else
                    return redirect()->route('filial.asignacionAsesores')->with('msg_error',' El Asesor no ha podido ser eliminado de la filial.');}
            else
                return redirect()->back();          
        }
        else
            return redirect('login');
    }

 }