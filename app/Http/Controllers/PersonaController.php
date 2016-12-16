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
        $this->asesorFilialRepo    =   $asesorFilialRepo;
	}

    // Página principal de Acesor
    public function lista(){

        $persona = $this->personaRepo->allEneable(); // Obtención de todos las personas activos
        return view('rol_filial.personas.lista',compact('persona'));
     
    }

    // Página de Nuevo
    public function nuevo(){
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        return view('rol_filial.personas.nuevo',compact('tipos'));    
    }

    // Alta persona
    public function nuevo_post(CrearNuevaPersonaRequest $request){
       
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

                foreach ($data['telefono'] as $key) {
                    
                    $telefono['persona_id'] = $persona->id;
                    $telefono['telefono'] = $key;
                    $this->personaTelefonoRepo->create($telefono);
                }

                foreach ($data['mail'] as $key) {

                    $mail['persona_id']=$persona->id;
                    $mail['mail']=$key;
                    $this->personaMailRepo->create($mail);
                }
               return redirect()->route('filial.personas')->with('msg_ok','La persona ha sida agregada con éxito');}
            else
                return redirect()->route('filial.personas')->with('msg_error','No se ha podido agregar a la persona, intente nuevamente.');
        }  
    }

    // Borrado lógico de la persona
    public function borrar($id){
       
        if($this->personaRepo->disable($this->personaRepo->find($id)))
            return redirect()->route('filial.personas')->with('msg_ok','La persona fue eliminada correctamente');
        else
            return redirect()->route('filial.personas')->with('msg_error',' La persona no ha podido ser eliminada.');       
    }

    // Página de Editar
    public function editar($id){
       
    	$persona   = $this->personaRepo->find($id); // Obtengo a la persona
    	$tipos     = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $mail      = $this->personaMailRepo->findMail($id);// Obtengo al mail
        $telefono  = $this->personaTelefonoRepo->findTelefono($id); // Obtengo al telefono
    	return view('rol_filial.personas.editar',compact('persona','tipos','mail','telefono')); 
    }

    //Modificación de la persona
    public function editar_post(EditarPersonaRequest $request){

        $data = $request->all();
        $model = $this->personaRepo->find($data['persona']); // Busco a la persona
          
        if($this->personaRepo->edit($model,$data)) // Modificación de los datos
        {
            $model->PersonaMail()->delete();
            $model->PersonaTelefono()->delete();

            foreach ($data['telefono'] as $key) {
                    
                $telefono['persona_id'] = $model->id;
                $telefono['telefono'] = $key;
                $this->personaTelefonoRepo->create($telefono);
            }

            foreach ($data['mail'] as $key) {

                $mail['persona_id']=$model->id;
                $mail['mail']=$key;
                $this->personaMailRepo->create($mail);
            }
            return redirect()->route('filial.personas')->with('msg_ok','La persona ha sido modificada con éxito.');}
        else
            return redirect()->route('filial.personas')->with('msg_error','La persona no ha podido ser modificada.');   
    }
}