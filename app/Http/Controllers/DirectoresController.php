<?php
namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Entities\TipoDocumento;
use App\Entities\Filial;
use App\Entities\DirectorTelefono;
use App\Entities\Cuenta;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CrearNuevoDirectorRequest;
use App\Http\Requests\EditarDirectorRequest;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\DirectorTelefonoRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Repositories\CuentaRepo;
use Mail;

class DirectoresController extends Controller
{
    protected $directorRepo;
    protected $cuentaRepo;

    public function __construct(CuentaRepo $cuentaRepo, DirectorRepo $directorRepo,TipoDocumento $tipoDocumentoRepo, DirectorTelefonoRepo $directorTelefonoRepo,FilialRepo $filialRepo){
        
        $this->directorRepo = $directorRepo;
        $this->tipoDocumentoRepo = $tipoDocumentoRepo;
        $this->directorTelefonoRepo = $directorTelefonoRepo;
        $this->filialRepo = $filialRepo;
        $this->cuentaRepo         = $cuentaRepo;
        $this->data['total_filiales'] = count($this->directorRepo->filialDirectores());
        $this->data['total_personas'] = $this->directorRepo->countTotalPersonas();
        $this->data['total_asesores'] = $this->directorRepo->countTotalAsesores();
    }

    
    public function index(){

        return view('rol_director.estadisticas.index')->with($this->data);  
    }



    public function editarPerfil($id){
        $director = $this->directorRepo->find($id);
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $telefono=$this->directorTelefonoRepo->findTelefono($id);

        return view('perfiles.director',compact('director','tipos','telefono'));
    }

    public function editarPerfil_post(Request $request){

        $data = $request->all();
        $cuenta=NULL;
        $mail=$data['maila'];
        $mailn=$data['mail'];
        $entidad=$data['id'];
        if  ($mail!==$mailn) {
            
            $cuenta = $this->cuentaRepo->actualizarCuenta($mail,$mailn,$entidad, 3);
            if ($cuenta !==null){
                // Datos del mail
                $user =$mailn;
                $datosMail = array( 'filial'    => $request->nombre, 
                                    'user'      => $user, 
                                    'password'  => $cuenta);
                // Envío del mail nuevo
                Mail::send('mailing.actualizacion_cuenta',$datosMail,function($msj) use($user){
                    $msj->subject('GeCo -- Actualización de Cuenta');
                    $msj->to($user);
                });
            } 
        }
        if ($cuenta !==null || $mail==$mailn){
            $model = $this->directorRepo->find($data['id']);
            if($this->directorRepo->edit($model,$data)){
                $model->DirectorTelefono()->delete();
                foreach ($data['telefono'] as $key) {

                    $telefono['director_id'] = $model->id;
                    $telefono['telefono'] = $key;
                    $this->directorTelefonoRepo->create($telefono);
                }

                return redirect()->back()->with('msg_ok','El perfil del director ha sido modificado con éxito.');}
            else
                return redirect()->back()->with('msg_error','El perfil del director no ha podido ser modificado.');
        }
        return redirect()->back()->with('msg_error','El perfil del director no ha podido ser modificado o existe el E-mail actual.');
    }


    public function estadisticas(){

    	return view('rol_director.estadisticas.index')->with($this->data);
    }

    public function detalles(Request $request){

        $array = explode("-", $request->get('fecha'));
        $inicio = helpersfuncionFecha($array[0]);
        $fin =  helpersfuncionFecha($array[1]);
        $tipo = $request->selectvalue;


        switch ($tipo) {

            case 'inscripcion':
                return $this->estadisticasDirectorInscripcion($inicio, $fin); break;

            case 'preinforme':
                return $this->estadisticasDirectorPreInforme($inicio, $fin); break;

            case 'recaudacion':
                return $this->estadisticasDirectorRecaudacion($inicio, $fin); break;

            case 'morosidad':
                return $this->estadisticasDirectorMorisidad($inicio, $fin); break;

            case 'examen':
                return $this->estadisticasDirectorExamen($inicio, $fin); break;
        }

    	return view('rol_director.estadisticas.index');
    }


    public function estadisticasDirectorInscripcion($inicio, $fin){

            //todas las filiales que le correspondan al director
            $secion = 'inscripcion';
            $labels  = helperslabelsEstadisticas();
            $nombres = helpersnombresEstadisticas();
            $disponibilidad =[];
            //$total = $this->personaRepo->all()->count();
            
            for($i =0; $i<count($labels); $i++ ){
                $data['label'] = $nombres[$i];
                $data['si'] = $this->directorRepo->estadisticasPersonas($labels[$i], 1, $inicio, $fin);
                $data['no'] = $this->directorRepo->estadisticasPersonas($labels[$i], 0, $inicio, $fin);
                array_push($disponibilidad, $data);
            }

            $total  = $this->directorRepo->countTotal($inicio, $fin);
            
            $genero = $this->directorRepo->getGenero($inicio,$fin);
            $nivelEstudios  = $this->directorRepo->estadisticasNivelEstudios($inicio, $fin);
            
            return view('rol_director.estadisticas.index',compact('total', 'disponibilidad', 'genero', 'nivelEstudios', 'secion'))->with($this->data);

    }

    public function estadisticasDirectorPreInforme($inicio, $fin){

        $this->data['secion'] = 'preinforme';
        $this->data['preinforme'] = $this->directorRepo->estadisticasPreInformes($inicio, $fin)->get()->groupBy('como_encontro');

        return view('rol_director.estadisticas.index')->with($this->data);
    }


    public function estadisticasDirectorRecaudacion($inicio, $fin){

        $this->data['secion']            = 'recaudacion';
        $this->data['recaudacion']       = $this->directorRepo->estadisticasRecaudacion($inicio, $fin);
        $this->data['total_recaudacion'] = $this->directorRepo->totalRecaudacion($inicio, $fin);
        

        return view('rol_director.estadisticas.index')->with($this->data);
    }

    public function estadisticasDirectorMorisidad($inicio, $fin){
        $this->data['secion']          = 'morosidad';
        $this->data['morosidad']       = $this->directorRepo->estadisticasMorosidad($inicio, $fin);
        $this->data['total_morosidad'] = $this->directorRepo->totalMorosidad($inicio, $fin);
        return view('rol_director.estadisticas.index')->with($this->data);
    }

    public function estadisticasDirectorExamen($inicio, $fin){
        $this->data['secion']        = 'examen';
        $this->data['examenes']      = $this->directorRepo->estadisticasExamen($inicio, $fin);
        return view('rol_director.estadisticas.index')->with($this->data);
    }




}