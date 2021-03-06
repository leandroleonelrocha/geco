<?php
namespace App\Http\Controllers;
use App\Entities\Docente;
use App\Entities\TipoDocumento;
use App\Entities\Clase;
use App\Http\Repositories\DocenteRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\ClaseRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Requests\CrearNuevoDocenteRequest;
use App\Http\Requests\EditarDocenteRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Auth;

class DocenteController extends Controller {

	protected $docenteRepo;
	
    public function __construct(DocenteRepo $docenteRepo, TipoDocumento $tipoDocumentoRepo, ClaseRepo $claseRepo)
	{
		$this->docenteRepo        = $docenteRepo;
		$this->tipoDocumentoRepo  = $tipoDocumentoRepo;
        $this->claseRepo         = $claseRepo;
	}

    // Página principal de Docentes
   public function lista(){
    
       $docentes = $this->docenteRepo->allEneable(); // Obtención de todos los docentes acrivos
       return view('rol_filial.docentes.lista',compact('docentes'));
}

    // Página de Nuevo
    public function nuevo(){
        
       $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
       return view('rol_filial.docentes.nuevo',compact('tipos'));    
    }

    // Alta Docente
    public function nuevo_post(CrearNuevoDocenteRequest $request){
        
    	$data = $request->all(); // Obtengo todos los datos del formulario
        $data['filial_id'] = session('usuario')['entidad_id'];
        
        // Corroboro que el cliente exista, si exite lo activa
        if ( $docente = $this->docenteRepo->check($data['tipo_documento_id'],$data['nro_documento']) ) {
                return redirect()->route('filial.docentes')->with('msg_ok','El docente ha sido agregado con éxito');
        }
        else{
            // Si no existe lo crea
            if($this->docenteRepo->create($data))
    	       return redirect()->route('filial.docentes')->with('msg_ok','El docente ha sido agregado con éxito');
            else
            return redirect()->route('filial.docentes')->with('msg_error','No se ha podido agregar al docente, intente nuevamente.');
        }  
    }

    // Borrado lógico del Docente
    public function borrar($id){
      
       if($this->docenteRepo->disable($this->docenteRepo->find($id)))
            return redirect()->route('filial.docentes')->with('msg_ok','Docente eliminado correctamente');
        else
           return redirect()->route('filial.docentes')->with('msg_error',' El docente no ha podido ser eliminado.'); 
    }

    // Página de Editar
    public function editar($id){
       
        $docente = $this->docenteRepo->find($id); // Obtengo al docente
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        return view('rol_filial.docentes.editar',compact('docente','tipos'));  
    }

    //Modificación del Docente
    public function editar_post(EditarDocenteRequest $request){
      
        $data = $request->all();
        $data['filial_id'] = session('usuario')['entidad_id'];
        $model = $this->docenteRepo->find($data['docente']); // Busco al docente
        if($this->docenteRepo->edit($model,$data)) // Modificación de los datos
            return redirect()->route('filial.docentes')->with('msg_ok','El docente ha sido modificado con éxito');
        else
            return redirect()->route('filial.docentes')->with('msg_error',' El docente no ha podido ser modificado.');
    }

    //Calculo de horas  Docente
    public function calcularHoras($id){

        $fecha1='1/11/26';
        $fecha2=date(("Y/m/d"));
    
        $clases = $this->claseRepo->clasesDocente($id,$fecha1,$fecha2);
        $docente = $this->docenteRepo->find($id);
        $horasTotala=0;
        $cantClasesa=0;
        $horasTotalp=0;
        $cantClasesp=0;
        foreach ($clases as $clase) {

            $horas=($clase->horario_hasta)-($clase->horario_desde);

            // if ($fecha2>=date("Y/m/d")){
            //     $horasTotalp += $horas; 
            //     $cantClasesp++;    
            // }

           // if ($fecha2<date("Y/m/d")){
                $horasTotala += $horas; 
                $cantClasesa++;    
            // }   
        }

        return view('rol_filial.docentes.calculoHoras.lista',compact('clases','horasTotalp','docente','cantClasesp','horasTotala','cantClasesa','fecha2'));  
    }

    public function calcularHorasBusqueda(Request $request){

        $data=$request->all();

        $fecha1=$data['fecha1'];
        $fecha2=$data['fecha2'];
        $id=$data['docente'];
        $clases = $this->claseRepo->clasesDocente($id,$fecha1,$fecha2);
        $docente = $this->docenteRepo->find($id);
        $horasTotala=0;
        $cantClasesa=0;
        $horasTotalp=0;
        $cantClasesp=0;
        foreach ($clases as $clase) {

            $horas=($clase->horario_hasta)-($clase->horario_desde);

            if ($clase->fecha >=date("Y/m/d")){
                $horasTotalp += $horas; 
                $cantClasesp++;    
            }

           if ($clase->fecha<date("Y/m/d")){
                $horasTotala += $horas; 
                $cantClasesa++;    
            }
        }
        return view('rol_filial.docentes.calculoHoras.lista',compact('clases','horasTotalp','docente','cantClasesp','horasTotala','cantClasesa'));    
    }
}