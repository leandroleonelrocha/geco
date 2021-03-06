<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MatriculaPermisosRepo;
use App\Http\Repositories\PersonaTelefonoRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Repositories\PersonaMailRepo;
use App\Http\Repositories\MatriculaRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\CarreraRepo;
use App\Http\Repositories\InteresRepo;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\GrupoRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\PaisRepo;
use App\Http\Requests\CrearNuevaMatriculaRequest;
use App\Http\Requests\CrearNuevaPersonaRequest;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Response;
use PDF;
use App;
use Redirect;

class MatriculaController extends Controller {

    protected $matriculaRepo;
    protected $tipoDocumentoRepo;

    public function __construct(MatriculaRepo $matriculaRepo, PersonaRepo $personaRepo, AsesorRepo $asesorRepo, TipoDocumentoRepo $tipoDocumentoRepo, PersonaMailRepo $personaMailRepo, PersonaTelefonoRepo $personaTelefonoRepo, CarreraRepo $carreraRepo, CursoRepo $cursoRepo, PagoRepo $pagoRepo, GrupoRepo $grupoRepo, MatriculaPermisosRepo $matriculaPermisosRepo, FilialRepo $filialRepo, PaisRepo $paisRepo)
    {
        $this->matriculaRepo            = $matriculaRepo;
        $this->personaRepo              = $personaRepo;
        $this->asesorRepo               = $asesorRepo;
        $this->tipoDocumentoRepo        = $tipoDocumentoRepo;
        $this->personaEmailRepo         = $personaMailRepo;
        $this->personaTelefonoRepo      = $personaTelefonoRepo;
        $this->carreraRepo              = $carreraRepo;
        $this->cursoRepo                = $cursoRepo;
        $this->pagoRepo                 = $pagoRepo;
        $this->grupoRepo                = $grupoRepo;
        $this->matriculaPermisosRepo    = $matriculaPermisosRepo;
        $this->filialRepo               = $filialRepo;
        $this->paisRepo                 = $paisRepo;
    }

    // Página principal de Matrículas
    public function lista(){
        
        $matriculas = $this->matriculaRepo->allEneable();
        return view('rol_filial.matriculas.lista',compact('matriculas'));
    }

    // Selección de Persona nueva o Existente
    public function seleccion(){
        $personas = $this->personaRepo->getPersonasFilial();
        return view('rol_filial.matriculas.seleccion',compact('personas'));
    }

    // Página de Nuevo -- Persona Existente
    public function nuevo($id){
        $filial=$this->filialRepo->obtenerFilialPais();
        foreach ($filial as $f) $pais_id=$f->pais_id;
        $pais=$this->paisRepo->obtenerLenguaje($pais_id);

        $persona    = $this->personaRepo->find($id);
        $asesores   = $this->asesorRepo->allAsesores()->lists('fullname','id');
        $cadena     = $this->filialRepo->filialCadena();
        $carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $grupos     = $this->grupoRepo->allEnable()->lists('id','descripcion');
        return view('rol_filial.matriculas.nuevo',compact('persona','asesores','carreras','cursos','grupos'));
    }

    // Página de Nuevo -- Persona Nueva
    public function nuevaPersona(){

        $filial=$this->filialRepo->obtenerFilialPais();
        foreach ($filial as $f) $pais_id=$f->pais_id;
        $pais=$this->paisRepo->obtenerLenguaje($pais_id);

        $tipos      = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $paises= $this->paisRepo->all()->lists('pais','id');
        $asesores   = $this->asesorRepo->allAsesores()->lists('fullname','id');
        $cadena     = $this->filialRepo->filialCadena();
        $carreras   = $this->carreraRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $cursos     = $this->cursoRepo->allLenguajeCadenaLista($pais->lenguaje,$cadena->cadena_id);
        $grupos     = $this->grupoRepo->allEnable()->lists('id','descripcion');
        return view('rol_filial.matriculas.nuevoPersona',compact('tipos','asesores','carreras','cursos','grupos','paises'));
    }

    // Alta de Matrícula y Persona Existente
    public function nuevo_post(Request $request){
       
        // Datos Matrícula
        $matricula['persona_id']        =   $request->persona;
        //Determinar si se seleccionó un Curso o Carrera
        $data = explode(';',$request->carreras_cursos);
        if ($data[0] == 'carrera')
            $matricula['carrera_id']    =   $data[1];
        elseif ($data[0] == 'curso')
            $matricula['curso_id']      =   $data[1];

        $matricula['filial_id']         =   session('usuario')['entidad_id'];
        $matricula['asesor_id']         =   $request->asesor;
        if($this->matriculaRepo->create($matricula)){
            $matricula                  =   $this->matriculaRepo->all()->last();
            // $permiso['matricula_id']    =   $matricula['id'];
            // $permiso['filial_id']       =   session('usuario')['entidad_id'];
            // $this->matriculaPermisosRepo->create($permiso);
            // Grupos
            $matricula->Grupo()->sync($request->grupo);
            // Pagos
            $pago['matricula_id']       =   $matricula['id'];
            for ($i=0; $i < count($request->nro_pago); $i++){
                $pago['nro_pago']       =   $request->nro_pago[$i];
                $pago['descripcion']    =   $request->descripcion[$i];
                $pago['vencimiento']    =   $request->vencimiento[$i];
                $pago['fecha_recargo']  =   $request->fecha_recargo[$i];
                $pago['monto_original'] =   $request->monto_original[$i];
                $pago['monto_actual']   =   $pago['monto_original'];
                $pago['descuento']      =   $request->descuento[$i];
                $pago['recargo']        =   $request->recargo[$i];
                $pago['filial_id']      =   session('usuario')['entidad_id'];
                $pago['tipo_moneda_id'] =   session('moneda')['id'];
                $this->pagoRepo->create($pago);
                $p[] = $this->pagoRepo->all()->last();
            }
                // return redirect()->route('filial.matriculas');
            
                return redirect()->route('filial.pagos_actualizar', $p[0]->id);
        }
        else
            return redirect()->route('filial.matriculas')->with('msg_error','La matrícula no ha podido ser agregado');
    }

    // Alta de Matrícula y Persona Nueva
    public function nuevaPersona_post(Request $request){
        // Datos Persona

        $data = $request->all();
        $persona['tipo_documento_id']       =   $request->tipo_documento;
        $persona['nro_documento']           =   $request->nro_documento;
        $persona['nombres']                 =   $request->nombres;
        $persona['apellidos']               =   $request->apellidos;
        $persona['genero']                  =   $request->genero;
        $persona['fecha_nacimiento']        =   $request->fecha_nacimiento;
        $persona['domicilio']               =   $request->domicilio;
        $persona['localidad']               =   $request->localidad;
        $persona['estado_civil']            =   $request->estado_civil;
        $persona['nivel_estudios']          =   $request->nivel_estudios;
        $persona['estudio_computacion']     =   $request->estudio_computacion;
        $persona['posee_computadora']       =   $request->posee_computadora;
        $persona['disponibilidad_manana']   =   $request->disponibilidad_manana;
        $persona['pais_id']                 =   $request->pais_id;
        $persona['disponibilidad_tarde']    =   $request->disponibilidad_tarde;
        $persona['disponibilidad_noche']    =   $request->disponibilidad_noche;
        $persona['disponibilidad_sabados']  =   $request->disponibilidad_sabados;
        $persona['aclaraciones']            =   $request->aclaraciones;
        $persona['filial_id']               =   session('usuario')['entidad_id'];
        if($this->personaRepo->create($persona)){
            //Datos Telefónicos y Mails
            $persona=$this->personaRepo->all()->last();

            foreach ($data['telefono'] as $key) {
                
                $telefono['persona_id'] = $persona->id;
                $telefono['telefono'] = $key;
                $this->personaTelefonoRepo->create($telefono);
            }

            foreach ($data['mail'] as $key) {

                $mail['persona_id']=$persona->id;
                $mail['mail']=$key;
                $this->personaEmailRepo->create($mail);
            }
            // Datos Matrícula
            $matricula['persona_id']       =   $persona['id'];
            //Determinar si se seleccionó un Curso o Carrera
            $data = explode(';',$request->carreras_cursos);
            if ($data[0] == 'carrera')
                $matricula['carrera_id']    =   $data[1];
            elseif ($data[0] == 'curso')
                $matricula['curso_id']      =   $data[1];

            $matricula['filial_id']         =   session('usuario')['entidad_id'];
            $matricula['asesor_id']         =   $request->asesor;
            if($this->matriculaRepo->create($matricula)){
                $matricula                  =   $this->matriculaRepo->all()->last();
                // $permiso['matricula_id']    =   $matricula['id'];
                // $permiso['filial_id']       =   session('usuario')['entidad_id'];
                // $this->matriculaPermisosRepo->create($permiso);
                // Grupos
                $matricula->Grupo()->sync($request->grupo);
                // Pagos
                $pago['matricula_id']       =   $matricula['id'];
                for ($i=0; $i < count($request->nro_pago); $i++){
                    $pago['nro_pago']       =   $request->nro_pago[$i];
                    $pago['descripcion']    =   $request->descripcion[$i];
                    $pago['vencimiento']    =   $request->vencimiento[$i];
                    $pago['fecha_recargo']  =   $request->fecha_recargo[$i];
                    $pago['monto_original'] =   $request->monto_original[$i];
                    $pago['monto_actual']   =   $pago['monto_original'];
                    $pago['descuento']      =   $request->descuento[$i];
                    $pago['recargo']        =   $request->recargo[$i];
                    $pago['filial_id']      =   session('usuario')['entidad_id'];
                    $pago['tipo_moneda_id'] =   session('moneda')->id;
                    $this->pagoRepo->create($pago);
                    $p[] = $this->pagoRepo->all()->last();
                }
                // return redirect()->route('filial.matriculas');
              
                return redirect()->route('filial.pagos_actualizar', $p[0]->id);
            }
            else
                return redirect()->route('filial.matriculas')->with('msg_error','La matrícula no ha podido ser agregado');
        }
    }

    public function editar($id){

        $asesores   = $this->asesorRepo->allAsesores()->lists('fullname','id');
        $matricula  = $this->matriculaRepo->find($id);

        if (isset($matricula->curso_id))
            $grupos = $this->grupoRepo->allGruposCurso($matricula->curso_id)->lists('id','id');
        else
            $grupos = $this->grupoRepo->allGruposCarrera($matricula->carrera_id)->lists('id','id');
        $planPagos          = $this->pagoRepo->allMatriculaPlan($id);
        $pagosIndividuales  = $this->pagoRepo->allMatriculaIndividual($id);
        return view('rol_filial.matriculas.editar',compact('matricula','planPagos','pagosIndividuales','asesores','carreras','cursos','grupos'));
    }

    public function editar_post(Request $request){
        $data                           = $request->all();
        $data['filial_id']              = session('usuario')['entidad_id'];

        // Datos de la Matrícula
        $matricula['asesor_id']         = $data['asesor'];
        if (!isset($data['cancelado']))
            $matricula['cancelado'] = 0;
        else
            $matricula['cancelado'] = $data['cancelado'];

       // Matrícula
        $modelM = $this->matriculaRepo->find($data['matricula']); // Busco la Matrícula
        if (isset($data['grupo']))
            $modelM->Grupo()->sync($data['grupo']);
        else
            return redirect()->back()->with('msg_error','Debe seleccionar al menos un grupo.');

        $this->matriculaRepo->edit($modelM,$matricula);

        return redirect()->route('filial.matriculas');
    }

    // Borrado lógico de la Matrícula
    public function borrar($id){
        if($this->matriculaRepo->disable($this->matriculaRepo->find($id)))
            return redirect()->route('filial.matriculas')->with('msg_ok','Matrícula eliminado correctamente');
        else
            return redirect()->route('filial.matriculas')->with('msg_error',' La Matrícula no ha podido ser eliminado.');
    }

    // Realización de los pagos de la Matrícula
    public function actualizar($id){
        $matricula  = $this->matriculaRepo->find($id);
        // if (isset($matricula->curso_id))
        //     $grupos = $this->grupoRepo->allGruposCurso($matricula->curso_id)->lists('id','id');
        // else
        //     $grupos = $this->grupoRepo->allGruposCarrera($matricula->carrera_id)->lists('id','id');
        // $grupos     = $this->grupoRepo->allEnable()->lists('id','id');
        return view('rol_filial.matriculas.actualizar',compact('matricula','grupos'));
    }

    // public function actualizar_post(Request $request){
    //     $data = $request->all();
    //     // Matrícula
    //     if (!isset($data['cancelado']))
    //         $matricula['cancelado'] = 0;
    //     else
    //         $matricula['cancelado'] = $data['cancelado'];
    //     $modelM = $this->matriculaRepo->find($data['matricula']);

    //     if ($this->matriculaRepo->edit($modelM,$matricula) && $modelM->Grupo()->sync($data['grupo']))
    //         return redirect()->route('filial.matriculas')->with('msg_ok',' La Matrícula ha sido actualizada con éxito.');
    //     else
    //         return redirect()->route('filial.matriculas')->with('msg_error',' La Matrícula no ha podido ser actualizada.');
    // }

    // Vista Detallada
    public function vista($id){
        $matricula           = $this->matriculaRepo->find($id);
        $pagos               = $this->pagoRepo->allMatricula($id);
        $planPagosV          = $this->pagoRepo->allMatriculaPlan($id);
        $pagosIndividualesV  = $this->pagoRepo->allMatriculaIndividual($id);
        // Se debe ejecutar solo 1 vez
        foreach ($pagos as $pago) {
            // Obtener fecha del primer día del mes
            $month   = date('m');
            $year    = date('Y');
            // $first   = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
            // $date1   = date_create ( $first );
            // Obtengo el día nro diez de cada mes
            // $date1->modify('+9 day');
            $actualDate   = date('Y-m-d');

            $recargo = $pago->monto_original * ( $pago->recargo * 0.01);
            $montoR  = $pago->monto_original + $recargo + $pago->recargo_adicional - $pago->monto_pago;
            $montoD  = $pago->monto_original - $pago->descuento - $pago->monto_pago - $pago->descuento_adicional;

            if($pago->monto_actual  != 0){
                if ($pago->fecha_recargo < $actualDate && $montoR != $pago->monto_actual){
                    $pago->monto_actual += $recargo;
                    $pago->save();
                }
                if ($actualDate <= $pago->vencimiento && $montoD != $pago->monto_actual && $pago->fecha_recargo > date('Y-m-d')) {
                    $pago->monto_actual -= $pago->descuento;
                    $pago->save();
                }
                if ($actualDate > $pago->vencimiento && $montoD == $pago->monto_actual && $pago->fecha_recargo > date('Y-m-d')) {
                    $pago->monto_actual += $pago->descuento;
                    $pago->save();
                }
            }
            
        }
        return view('rol_filial.matriculas.vista',compact('matricula','planPagosV','pagosIndividualesV'));
    }

    //Pase
    public function pase($id){
        $cadena     = $this->filialRepo->filialCadena();
        $filiales   = $this->filialRepo->allFilial($cadena->cadena_id);
        $matricula  = $id;
        return view('rol_filial.matriculas.pase',compact('filiales','matricula'));
    }

    public function pase_nuevo($filial, $matricula){
        $permiso['matricula_id']  = $matricula;
        $permiso['filial_id']     = $filial;
        $permiso['confirmar']     = false;
        if ($this->matriculaPermisosRepo->create($permiso))
            return redirect()->route('filial.matriculas_pases')->with('msg_ok', 'Ha comenzado la operación de pase.');
        else{
            $matriculas = $this->matriculaRepo->allEneable();
            return redirect()->route('filial.matriculas')->with('msg_error', 'Ha ocurrido un error, ´vuelva a intentarlo más tarde.');
        }
    }

    //Pases
    public function pases(){
        $pasesEmitidos  = $this->matriculaRepo->allPasesSend();
        $pasesRecibidos = $this->matriculaPermisosRepo->allFilial();
        return view('rol_filial.matriculas.pases',compact('pasesEmitidos','pasesRecibidos'));
    }

    //Confirmar
    public function confirmar($id){
        $permiso = $this->matriculaPermisosRepo->find($id);
        $permiso->confirmar = 1;
        $resultado = '<i class="btn btn-success glyphicon glyphicon-ok" title="Confirmado"></i>';

        if ($permiso->save())
            return Response::json($resultado,200);
    }

    public function rechazar($id){
        $permiso = $this->matriculaPermisosRepo->find($id);
        if($permiso->Delete())
            return Response::json(true,200);
        else
            return Response::json(false,200);
    }

    public function matriculas_grupos(Request $request){
        if ($request->tipo == "carrera")
            $grupos = $this->grupoRepo->allGruposCarrera($request->id);
        else
            $grupos = $this->grupoRepo->allGruposCurso($request->id);

        foreach ($grupos as $g) { $g->lang = App::getLocale(); } // Negrada?

        return response()->json($grupos, 200);
    }

    public function matriculas_imprimir($id){

        $matricula      = $this->matriculaRepo->find($id);
   
        
        $pdf            = PDF::loadView('impresiones.matricula',compact('matricula'));
       
        return $pdf->stream();

    }

   public function imprimir_plan_de_pago($id){

        //$pdf->stream('impresiones.impresion_plan_de_pago',array('Attachment'=>0));
        //$pago           = $this->pagoRepo->find($id);
        
        $matricula      = $this->matriculaRepo->find($id);
        $pdf            = PDF::loadView('impresiones.impresion_plan_de_pago', compact('matricula'));
       
        return $pdf->stream();

   } 

   public function matricula_prueba(Request $request)
   {

        dd($request->all());
        $matricula      = $this->matriculaRepo->find(1000);
        $pdf            = PDF::loadView('impresiones.impresion_plan_de_pago', compact('matricula'));
       
        return $pdf->stream();

   }


}