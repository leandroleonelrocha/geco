<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\ExamenRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\DuenoRepo;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\AsesorRepo;
use App\Http\Repositories\DirectorRepo;
use App\Http\Repositories\DirectorTelefonoRepo;
use App\Http\Repositories\TipoDocumentoRepo;
use App\Http\Requests\CrearNuevoDirectorRequest;
use App\Http\Requests\EditarDirectorRequest;
use App\Entities\TipoDocumento;
use App\Entities\Filial;
use App\Entities\DirectorTelfono;
use App\Entities\Persona;
use Mail;

class DuenoController extends Controller
{
	protected $examenRepo;
	protected $personaRepo;
	protected $duenoRepo;
	protected $filialRepo;
	protected $asesorRepo;
	protected $directorRepo;
    protected $data;

	public function __construct(TipoDocumento $tipoDocumentoRepo, DirectorTelefonoRepo $directorTelefonoRepo, DirectorRepo $directorRepo,ExamenRepo $examenRepo, PersonaRepo $personaRepo, DuenoRepo $duenoRepo, FilialRepo $filialRepo, AsesorRepo $asesorRepo ){
		$this->examenRepo  			 = $examenRepo;
		$this->personaRepo 			 = $personaRepo;
		$this->duenoRepo  			 = $duenoRepo;
		$this->filialRepo 			 = $filialRepo;
		$this->asesorRepo  			 = $asesorRepo;
		$this->directorRepo          = $directorRepo; 
        $this->tipoDocumentoRepo     = $tipoDocumentoRepo;
        $this->directorTelefonoRepo  = $directorTelefonoRepo;
        $this->data['total_persona'] = $this->personaRepo->all()->count();
		$this->data['total_filial']  = $this->filialRepo->all()->count();
		$this->data['total_asesor']  = $this->asesorRepo->all()->count();	
		
	}


    public function lista(){
        $directores=$this->directorRepo->allEneable();
        return view('rol_dueno.directores.lista', compact('directores'));   
    }

    public function nuevo(){
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        return view('rol_dueno.directores.nuevo', compact('tipos'));
    } 

    public function nuevo_post(CrearNuevoDirectorRequest $request){
        
        // Corroboro que el cliente exista, si exite lo activa
        $data = $request->all();
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/activarCuenta/{$request->mail}/3");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $pass = json_decode(curl_exec($ch),true);
        curl_close($ch);

        if ($pass){
            if ( $director = $this->directorRepo->check($data['mail']))
            {// Datos del mail        
                $user = $request->mail;
                $nombrefull= $request->nombres . " " . $request->apellidos; 
                $datosMail = array( 'filial'    => $nombrefull, 
                            'user'      => $user, 
                            'password'  => $pass);
                // Envío del mail
                Mail::send('mailing.reactivacion_cuenta',$datosMail,function($msj) use($user){
                    $msj->subject('GeCo -- Reactivación Cuenta');
                    $msj->to($user);
                });
                return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido agregado con éxito');
            }
            else
                return redirect()->route('dueño.directores')->with('msg_error','El director no ha sido agregado');
        }
        if ($pass==0){ // Si no existe lo crea al director
            if ($this->directorRepo->existeMail($request->mail) || $this->filialRepo->existeMail($request->mail))
                  return redirect()->route('dueño.directores_nuevo')->with('msg_error', 'El E-Mail de la cuenta ya existe, intente con otro E-Mail.');
            else{
                if($this->directorRepo->create($data)){

                    $director=$this->directorRepo->all()->last();
                    foreach ($data['telefono'] as $key) {
                        $telefono['director_id'] = $director->id;
                        $telefono['telefono'] = $key;
                        $this->directorTelefonoRepo->create($telefono);
                    }
                    $ch = curl_init();  
                    curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/cuentaCreate/{$request->mail}/{$director->id}/3");  
                    curl_setopt($ch, CURLOPT_HEADER, false);  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
                    $pass = json_decode(curl_exec($ch),true);
                    curl_close($ch);

                    // Datos del mail
                    $user = $request->mail;
                    $nombrefull= $request->nombres . " " . $request->apellidos; 
                    $datosMail = array( 'filial'    => $nombrefull, 
                                'user'      => $user, 
                                'password'  => $pass);
                    // Envío del mail
                    Mail::send('mailing.cuenta',$datosMail,function($msj) use($user){
                        $msj->subject('GeCo -- Nueva Cuenta');
                        $msj->to($user);
                    });
                    return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido creado con éxito.');}
                else
                    return redirect()->route('dueño.directores')->with('msg_error','No se ha podido crear al director, intente nuevamente.');
            }
        }
    }

    public function borrar($id){

        $cuenta=$this->directorRepo->find($id);
        $mail=$cuenta->mail;
       
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/borrarCuenta/{$mail}");  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

        if ($data){
            if($this->directorRepo->disable($this->directorRepo->find($id)))
                return redirect()->back()->with('msg_ok', 'Director eliminado correctamente.');
            else
                return redirect()->back()->with('msg_error','El director no ha podido ser eliminado.');}
        else
            return redirect()->back()->with('msg_error', 'El director no ha sido encontrado o no se puede eliminar.');
    }

    public function editar($id){
        $director = $this->directorRepo->find($id);
        $tipos = $this->tipoDocumentoRepo->all()->lists('tipo_documento','id');
        $telefono=$this->directorTelefonoRepo->findTelefono($id);
        return view('rol_dueno.directores.editar',compact('director','tipos','telefono'));
    }

    public function editar_post(EditarDirectorRequest $request){

        $data = $request->all();
        $pass=NULL;
        $mail=$data['maila'];
        $mailn=$data['mail'];
        $entidad=$data['id'];
        if  ($mail!==$mailn) {
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, "http://laravelprueba.esy.es/laravel/public/cuenta/actualizarCuenta/{$mail}/{$mailn}/{$entidad}/3");  
            curl_setopt($ch, CURLOPT_HEADER, false);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $pass = json_decode(curl_exec($ch),true);
            curl_close($ch);
            if ($pass !==null){
                // Datos del mail
                $user =$mailn;
                $datosMail = array( 'filial'    => $request->nombre, 
                                    'user'      => $user, 
                                    'password'  => $pass);
                // Envío del mail nuevo
                Mail::send('mailing.actualizacion_cuenta',$datosMail,function($msj) use($user){
                    $msj->subject('GeCo -- Actualización de Cuenta');
                    $msj->to($user);
                });
            } 
        }
        if ($pass !==null || $mail==$mailn){
            $model = $this->directorRepo->find($data['id']);
            if($this->directorRepo->edit($model,$data)){
              
                $model->DirectorTelefono()->delete();
                foreach ($data['telefono'] as $key) {
                    $telefono['director_id'] = $model->id;
                    $telefono['telefono'] = $key;
                    $this->directorTelefonoRepo->create($telefono);
                }
                return redirect()->route('dueño.directores')->with('msg_ok','El director ha sido modificado con éxito.');}
            else
                return redirect()->route('dueño.directores')->with('msg_error','El director no ha podido ser modificado.');
            }
        else
            return redirect()->route('dueño.directores')->with('msg_error','El director no ha podido ser modificado o existe el E-mail actual.');
    }
	
	public function index(){
		
		return view('rol_dueno.estadisticas.index')->with($this->data);	
	
	}

	public function estadisticas()
	{
	
		return view('rol_dueno.estadisticas.index')->with($this->data);	
	}

	public function detalles(Request $request){


		$array 	=	explode("-", $request->get('fecha'));
        $inicio =	helpersfuncionFecha($array[0]);
        $fin 	=	helpersfuncionFecha($array[1]);
		$tipo 	=	$request->selectvalue;
		

		switch ($tipo) {

			case 'inscripcion':
			return $this->estadisticasDuenoInscripcion($inicio, $fin); break;

			case 'preinforme':
			return $this->estadisticasDuenoPreinforme($inicio, $fin); break;

			case 'recaudacion':
			return $this->estadisticasDuenoRecaudacion($inicio, $fin); break;

			case 'morosidad':
			return $this->estadisticasDuenoMorisidad($inicio, $fin); break;

			case 'examen':
			return $this->estadisticasDuenoExamen($inicio, $fin); break;
		}

	}



	public function estadisticasDuenoInscripcion($inicio, $fin)
	{		
			$secion 		= 'inscripcion';
			$labels  		= helperslabelsEstadisticas();
            $nombres 		= helpersnombresEstadisticas();
            $disponibilidad = [];
			

			for($i =0; $i<count($labels); $i++ ){
                $data['label']	= $nombres[$i];
				$data['si']		= $this->duenoRepo->poseeComputadora($labels[$i], 1, $inicio, $fin);
				$data['no'] 	= $this->duenoRepo->poseeComputadora($labels[$i], 0, $inicio, $fin);
				array_push($disponibilidad, $data);
			}

			$genero 		= $this->duenoRepo->getGenero($inicio,$fin);
            $nivelEstudios  = $this->duenoRepo->estadisticasNivelEstudios($inicio, $fin);
          		
			return view('rol_dueno.estadisticas.index',compact('total', 'disponibilidad', 'genero', 'nivelEstudios', 'secion','total_filial', 'total_persona', 'total_asesor'))->with($this->data);
	}


	public function estadisticasDuenoPreinforme($inicio, $fin){

		$secion 		= 	'preinforme';
		$preinforme 	= 	$this->duenoRepo->preInformes($inicio, $fin)->get()->groupBy('como_encontro');
		
		return view('rol_dueno.estadisticas.index', compact('preinforme','secion','total_persona','total_filial','total_asesor'))->with($this->data);	
	}

	public function estadisticasDuenoRecaudacion($inicio, $fin){

		return 'recaudacion';
	}


	public function estadisticasDuenoMorisidad($inicio, $fin){

		return 'morosidad';
	}

	public function estadisticasDuenoExamen($inicio, $fin){
			$examenes = $this->examenRepo->allExamenFilialMatricula()->groupBy('nro_acta');
			foreach ($examenes as $key => $value) {
				dd($key);
			}
	}

}