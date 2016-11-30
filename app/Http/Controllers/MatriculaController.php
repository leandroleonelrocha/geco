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
use App\Http\Repositories\AsesorFilialRepo;
use App\Http\Repositories\GrupoRepo;
use App\Http\Repositories\CursoRepo;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\FilialRepo;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Response;

class MatriculaController extends Controller {

    protected $matriculaRepo;
    protected $tipoDocumentoRepo;

    public function __construct(MatriculaRepo $matriculaRepo, PersonaRepo $personaRepo, AsesorRepo $asesorRepo, AsesorFilialRepo $asesorFilialRepo, TipoDocumentoRepo $tipoDocumentoRepo, PersonaMailRepo $personaMailRepo, PersonaTelefonoRepo $personaTelefonoRepo, CarreraRepo $carreraRepo, CursoRepo $cursoRepo, PagoRepo $pagoRepo, GrupoRepo $grupoRepo, MatriculaPermisosRepo $matriculaPermisosRepo, FilialRepo $filialRepo)
    {
        $this->matriculaRepo            = $matriculaRepo;
        $this->personaRepo              = $personaRepo;
        $this->asesorRepo               = $asesorRepo;
        $this->asesorFilialRepo         = $asesorFilialRepo;
        $this->tipoDocumentoRepo        = $tipoDocumentoRepo;
        $this->personaEmailRepo         = $personaMailRepo;
        $this->personaTelefonoRepo      = $personaTelefonoRepo;
        $this->carreraRepo              = $carreraRepo;
        $this->cursoRepo                = $cursoRepo;
        $this->pagoRepo                 = $pagoRepo;
        $this->grupoRepo                = $grupoRepo;
        $this->matriculaPermisosRepo    = $matriculaPermisosRepo;
        $this->filialRepo               = $filialRepo;
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
        $persona    = $this->personaRepo->find($id);
        $asesores   = $this->asesorFilialRepo->allAsesorFilial()->lists('fullname','asesor_id');
        $carreras   = $this->carreraRepo->all();
        $cursos     = $this->cursoRepo->all();
        $grupos     = $this->grupoRepo->allEnable()->lists('id','id');
        return view('rol_filial.matriculas.nuevo',compact('persona','asesores','carreras','cursos','grupos'));
    }

    // Página de Nuevo -- Persona Nueva
    public function nuevaPersona(){
        $tipos      = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $asesores   = $this->asesorFilialRepo->allAsesorFilial()->lists('fullname','asesor_id');
        $carreras   = $this->carreraRepo->all();
        $cursos     = $this->cursoRepo->all();
        $grupos     = $this->grupoRepo->allEnable()->lists('id','id');
        return view('rol_filial.matriculas.nuevoPersona',compact('tipos','asesores','carreras','cursos','grupos'));
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
                $pago['monto_original'] =   $request->monto_original[$i];
                $pago['monto_actual'] =     $pago['monto_original'];
                $pago['descuento']      =   $request->descuento[$i];
                $pago['recargo']        =   $request->recargo[$i];
                $pago['filial_id']      =   session('usuario')['entidad_id'];
                $this->pagoRepo->create($pago);
            }
            return redirect()->route('filial.matriculas');
        }
        else
            return redirect()->route('filial.matriculas')->with('msg_error','La matrícula no ha podido ser agregado');
    }

    // Alta de Matrícula y Persona Nueva
    public function nuevaPersona_post(Request $request){
        // Datos Persona
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
        $persona['disponibilidad_tarde']    =   $request->disponibilidad_tarde;
        $persona['disponibilidad_noche']    =   $request->disponibilidad_noche;
        $persona['disponibilidad_sabados']  =   $request->disponibilidad_sabados;
        $persona['aclaraciones']            =   $request->aclaraciones;
        $persona['filial_id']               =   session('usuario')['entidad_id'];
        $persona['asesor_id']               =   $request->asesor;
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
                $this->personaMailRepo->create($mail);
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
                    $pago['monto_original'] =   $request->monto_original[$i];
                    $pago['monto_actual']   =     $pago['monto_original'];
                    $pago['descuento']      =   $request->descuento[$i];
                    $pago['recargo']        =   $request->recargo[$i];
                    $pago['filial_id']      =   session('usuario')['entidad_id'];
                    $this->pagoRepo->create($pago);
                }
                return redirect()->route('filial.matriculas');
            }
            else
                return redirect()->route('filial.matriculas')->with('msg_error','La matrícula no ha podido ser agregado');
        }
    }

    public function editar($id){
        $matricula  = $this->matriculaRepo->find($id);
        $pagos      = $this->pagoRepo->allMatricula($id);
        $asesores   = $this->asesorFilialRepo->allAsesorFilial()->lists('fullname','asesor_id');
        $carreras   = $this->carreraRepo->all();
        $cursos     = $this->cursoRepo->all();
        $grupos     = $this->grupoRepo->allEnable()->lists('id','id');
        return view('rol_filial.matriculas.editar',compact('matricula','pagos','asesores','carreras','cursos','grupos'));
    }

    public function editar_post(Request $request){
        $data                           = $request->all();
        $data['filial_id']              = session('usuario')['entidad_id'];

        // Datos de la Matrícula
        $matricula['asesor_id']         = $data['asesor'];
        //Determinar si se seleccionó un Curso o Carrera
        $cs = explode(';',$request->carreras_cursos);
        if ($cs[0] == 'carrera'){
            $matricula['carrera_id']    =   $cs[1];
            $matricula['curso_id']      =   null;
        }
        elseif ($cs[0] == 'curso'){
            $matricula['curso_id']      =   $cs[1];
            $matricula['carrera_id']    =   null;
        }

       // Matrícula
        $modelM = $this->matriculaRepo->find($data['matricula']); // Busco la Matrícula
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
        $grupos     = $this->grupoRepo->allEnable()->lists('id','id');
        return view('rol_filial.matriculas.actualizar',compact('matricula','grupos'));
    }

    public function actualizar_post(Request $request){
        $data = $request->all();
        // Matrícula
        if (!isset($data['cancelado']))
            $matricula['cancelado'] = 0;
        else
            $matricula['cancelado'] = $data['cancelado'];
        $modelM = $this->matriculaRepo->find($data['matricula']);

        if ($this->matriculaRepo->edit($modelM,$matricula) && $modelM->Grupo()->sync($data['grupo']))
            return redirect()->route('filial.matriculas')->with('msg_ok',' La Matrícula ha sido actualizada con éxito.');
        else
            return redirect()->route('filial.matriculas')->with('msg_error',' La Matrícula no ha podido ser actualizada.');
    }

    // Vista Detallada
    public function vista($id){
        $matricula  = $this->matriculaRepo->find($id);
        $pagos  = $this->pagoRepo->allMatricula($id);
        // Se debe ejecutar solo 1 vez
        foreach ($pagos as $pago) {
            // Obtener fecha del primer día del mes
            $month   = date('m');
            $year    = date('Y');
            $first   = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
            $date1   = date_create ( $first );
            $date2   = date_create ( date('Y-m-d') );
            // Obtengo el día nro diez de cada mes
            $date1->modify('+9 day');

            $recargo = $pago->monto_original * ( $pago->recargo * 0.01);
            $montoR  = $pago->monto_original + $recargo - $pago->monto_pago;
            $montoD  = $pago->monto_original - $pago->descuento - $pago->monto_pago;
            
            if ($pago->vencimiento < date('Y-m-d') && $montoR != $pago->monto_actual){
                $pago->monto_actual += $recargo;
                $pago->save();
            }
            if ($date2 <= $date1 && $montoD != $pago->monto_actual && $pago->vencimiento > date('Y-m-d')) {
                $pago->monto_actual -= $pago->descuento;
                $pago->save();
            }
            if ($date2 >= $date1 && $montoD == $pago->monto_actual && $pago->vencimiento > date('Y-m-d')) {
                $pago->monto_actual += $pago->descuento;
                $pago->save();
            }
        }
        return view('rol_filial.matriculas.vista',compact('matricula','pagos'));
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
}