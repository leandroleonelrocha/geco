<?php
namespace App\Http\Controllers;
use App\Entities\Asesor;
use App\Entities\TipoDocumento;
use App\Entities\Persona;
use App\Entities\PersonaMail;
use App\Entities\PersonaTelefono;
use App\Entities\AsesorFilial;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PersonaMailRepo;
use App\Http\Repositories\PersonaTelefonoRepo;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\AsesorFilialRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Requests\CrearNuevaPersonaRequest;
use App\Http\Requests\EditarPersonaRequest;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
class PersonaController extends Controller {

	protected $personaRepo;
	
    public function __construct(PersonaRepo $personaRepo, TipoDocumento $tipoDocumentoRepo, PersonaMailRepo $personaMailRepo, PersonaTelefonoRepo $personaTelefonoRepo, AsesorRepo $asesorRepo, AsesorFilialRepo $asesorFilialRepo  )
	{
		$this->personaRepo         =   $personaRepo;
		$this->tipoDocumentoRepo   =   $tipoDocumentoRepo;
        $this->personaMailRepo     =   $personaMailRepo;
        $this->personaTelefonoRepo =   $personaTelefonoRepo;
        $this->asesorRepo          =   $asesorRepo;
        $this->asesorFilialRepo    =   $asesorFilialRepo;

	}

    // Página principal de Acesor
    public function lista(){
        
        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
                $persona = $this->personaRepo->allEneable(); // Obtención de todos las personas activos
                return view('rol_filial.personas.lista',compact('persona'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    // Página de Nuevo
    public function nuevo(){
        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
            	$tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
                $asesores   = $this->asesorFilialRepo->allAsesorFilial()->lists('fullname','asesor_id');
 
            	return view('rol_filial.personas.nuevo',compact('tipos','asesores'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    // Alta persona
    public function nuevo_post(CrearNuevaPersonaRequest $request){
       
        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
            	$data = $request->all(); // Obtengo todos los datos del formulario
                
                // Corroboro que la persona exista, si exite lo activa
                if ( $persona = $this->personaRepo->check($data['tipo_documento_id'],$data['nro_documento']) ) {
                        return redirect()->route('filial.personas')->with('msg_ok','La persona ha sida agregada con éxito');
                }
                else{
                    // Si no existe lo crea

                    $data['filial_id'] = session('usuario')['entidad_id'];
                    $data['asesor_id'] = $request->asesor_id;

                    if($this->personaRepo->create($data)){

                        $persona=$this->personaRepo->all()->last();

                        $mail['persona_id']=$persona->id;
                        $mail['mail']=$request->mail;
                        $this->personaMailRepo->create($mail);

                        $telefono['persona_id']=$persona->id;
                        $telefono['telefono']=$request->telefono;
                        $this->personaTelefonoRepo->create($telefono);
             
            	       return redirect()->route('filial.personas')->with('msg_ok','La persona ha sida agregada con éxito');}
                   else
                    return redirect()->route('filial.personas')->with('msg_error','No se ha podido agregar a la persona, intente nuevamente.');
                }
            }
            else
                return redirect()->back();  
        }
        else
            return redirect('login');
    }

    // Borrado lógico de la persona
    public function borrar($id){
        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
                if($this->personaRepo->disable($this->personaRepo->find($id)))
                    return redirect()->route('filial.personas')->with('msg_ok','La persona fue eliminada correctamente');
                else
                    return redirect()->route('filial.personas')->with('msg_error',' La persona no ha podido ser eliminada.');
            }
            else
                return redirect()->back();   
        }
        else
            return redirect('login');
    }

    // Página de Editar
    public function editar($id){
        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
            	$persona = $this->personaRepo->find($id); // Obtengo a la persona
            	$tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
                $asesores = $this->asesorFilialRepo->allAsesorFilial()->lists('fullname','asesor_id');
                $mail=$this->personaMailRepo->findMail($id);// Obtengo al mail
                $telefono=$this->personaTelefonoRepo->findTelefono($id); // Obtengo al telefono
            	return view('rol_filial.personas.editar',compact('persona','tipos','asesores','mail','telefono'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    //Modificación de la persona
    public function editar_post(EditarPersonaRequest $request){

        if (null !== session('usuario')){
            if (session('usuario')['rol_id'] == 4){
                $data = $request->all();

                $model = $this->personaRepo->find($data['persona']); // Busco a la persona
                
                if($this->personaRepo->edit($model,$data)) // Modificación de los datos
                {
                    //editar mail
                    $this->personaMailRepo->editMail($data['persona'],$data['mail']); 
                     //editar telefono
                    $this->personaTelefonoRepo->editTelefono($data['persona'],$data['telefono']); 
                   
                    return redirect()->route('filial.personas')->with('msg_ok','La persona ha sido modificada con éxito.');}
                else
                    return redirect()->route('filial.personas')->with('msg_error','La persona no ha podido ser modificada.');
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }
}