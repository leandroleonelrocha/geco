<?php
namespace App\Http\Controllers;
use App\Entities\Asesor;
use App\Entities\TipoDocumento;
use App\Entities\AsesorMail;
use App\Entities\AsesorTelefono;
use App\Entities\AsesorFilial;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\AsesorMailRepo;
use App\Http\Repositories\AsesorTelefonoRepo;
use App\Http\Repositories\AsesorFilialRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Requests\CrearNuevoAsesorRequest;
use App\Http\Requests\EditarAsesorRequest;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AsesorController extends Controller {

	protected $asesorRepo;
	
    public function __construct(AsesorRepo $asesorRepo, TipoDocumento $tipoDocumentoRepo, AsesorMailRepo $asesorMailRepo, AsesorTelefonoRepo $asesorTelefonoRepo,AsesorFilialRepo $asesorFilialRepo)
	{
		$this->asesorRepo        = $asesorRepo;
		$this->tipoDocumentoRepo  = $tipoDocumentoRepo;
        $this->asesorMailRepo  = $asesorMailRepo;
        $this->asesorTelefonoRepo  = $asesorTelefonoRepo;
        $this->asesorFilialRepo  = $asesorFilialRepo;
	}
    // Página principal de Acesor
    public function lista(){
        $asesores = $this->asesorRepo->allAsesores(); // Obtención de todos los Acesores activos
        return view('rol_filial.asesores.lista',compact('asesores'));     
    }

    // Página de Nuevo
    public function nuevo(){
       
       $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
       return view('rol_filial.asesores.nuevo',compact('tipos'));
    }

  
    // Alta Asesor
    public function nuevo_post(CrearNuevoAsesorRequest $request){

        $data = $request->all(); // Obtengo todos los datos del formulario             
        // Corroboro que el asesor exista, si exite lo activa

        if ( $asesor = $this->asesorRepo->check($data['tipo_documento_id'],$data['nro_documento']) )
                return redirect()->route('filial.asesores')->with('msg_ok','El asesor ha sido agregado con éxito.');
        else{
            // Si no existe lo crea
            $data['filial_id'] = session('usuario')['entidad_id'];
            if($this->asesorRepo->create($data)){

                $asesor=$this->asesorRepo->all()->last();
                
                foreach ($data['mail'] as $key) {
                    
                    $mail['asesor_id'] = $asesor->id;
                    $mail['mail'] = $key;
                    $this->asesorMailRepo->create($mail); 
                }

                foreach ($data['telefono'] as $key) {
                    
                    $telefono['asesor_id'] = $asesor->id;
                    $telefono['telefono'] = $key;
                    $this->asesorTelefonoRepo->create($telefono);
                }
            
                return redirect()->route('filial.asesores')->with('msg_ok','El asesor ha sido agregado con éxito.');}
           else
                return redirect()->route('filial.asesores')->with('msg_error','No se ha podido agregar al asesor, intente nuevamente.');
        }
    }
    // Página de Editar
    public function editar($id){
        
        $asesor = $this->asesorRepo->find($id); // Obtengo al Asesor
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $mail=$this->asesorMailRepo->findMail($id);
        $telefono=$this->asesorTelefonoRepo->findTelefono($id); 
        return view('rol_filial.asesores.editar',compact('asesor','tipos','mail','telefono'));      
    }
    //Modificación del Asesor
    public function editar_post(EditarAsesorRequest $request){
       
        $data = $request->all();
               
        $model = $this->asesorRepo->find($data['asesor']);

        if($this->asesorRepo->edit($model,$data)) // Modificación de los datos
            {
                   
            $model->AsesorMail()->delete();
            $model->AsesorTelefono()->delete();
            foreach ($data['mail'] as $key) {
            $mail['asesor_id'] = $model->id;
            $mail['mail'] = $key;
            $this->asesorMailRepo->create($mail);
            }

            foreach ($data['telefono'] as $key) {
            $telefono['asesor_id'] = $model->id;
            $telefono['telefono'] = $key;
            $this->asesorTelefonoRepo->create($telefono);
            }

             return redirect()->route('filial.asesores')->with('msg_ok','El asesor ha sido modificado con éxito.');
             }
            else
        return redirect()->route('filial.asesores')->with('msg_error',' El asesor no ha podido ser modificado.');       
    }

    // Borrado lógico del Asesor
    public function borrar($id){
       
       if($this->asesorRepo->disable($this->asesorRepo->find($id)))
            return redirect()->route('filial.asesores')->with('msg_ok','Asesor eliminado correctamente');
        else
            return redirect()->route('filial.asesores')->with('msg_error',' El asesor no ha podido ser eliminado.');  
    }
}
