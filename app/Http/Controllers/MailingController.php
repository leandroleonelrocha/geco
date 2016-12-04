<?php

namespace App\Http\Controllers;
use Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Repositories\FilialRepo;
use App\Http\Repositories\MailingRepo;
use App\Http\Repositories\PagoRepo;
use App\Http\Repositories\PersonaRepo;
use App\Http\Repositories\PersonaMailRepo;
use App\Http\Repositories\GrupoRepo;
use App\Http\Repositories\MatriculaRepo;
use App\Http\Repositories\ClaseRepo;
// use Mail;

class MailingController extends Controller
{
	protected $cursoRepo;

	public function __construct(FilialRepo $filialRepo, MailingRepo $mailingRepo, PagoRepo $pagoRepo, PersonaRepo $personaRepo, PersonaMailRepo $personaMailRepo, GrupoRepo $grupoRepo, MatriculaRepo $matriculaRepo, ClaseRepo $claseRepo)
	{
		$this->filialRepo 		= 	$filialRepo;
		$this->mailingRepo 		= 	$mailingRepo;
		$this->pagoRepo 		= 	$pagoRepo;
		$this->personaRepo 		= 	$personaRepo;
		$this->personaMailRepo 	= 	$personaMailRepo;
		$this->grupoRepo 		= 	$grupoRepo;
		$this->matriculaRepo 	= 	$matriculaRepo;
		$this->claseRepo 		= 	$claseRepo;
	}

	// Obtencion de todos los mails de las personas cuya clase ha sido cancelada
	public function mailClaseCancelada(){
		$clases = $this->claseRepo->allCancelado();
		if( count($clases) > 0 ){
			foreach ($clases as $c) {
			foreach ($c->Grupo->Matricula as $m) {
				$pe[] = $m->Persona;
				}
			}
			foreach ($pe as $p) {
				foreach ($p->PersonaMail as $pm) {
					$personaMail[] = $pm->mail;
				}
			}
			return $personaMail;
		}
		else return null;
	}
	
	public function lista(){
		$cantAviso 		= count($this->personaRepo->allPreMorosos());
		$cantMorosos 	= count($this->personaRepo->allMorosos());
		$cantClase 		= count($this->mailClaseCancelada());
		$cantInteres 	= count($this->personaRepo->allInteresCursoGrupo()) + count($this->personaRepo->allInteresCarreraGrupo());
		if ( count($this->grupoRepo->allNuevo()) >0 )
			$cantGrupos 	= count($this->personaMailRepo->allMailPersonaFilial());
		else
			$cantGrupos 	= 0;

		return view('rol_filial.mails.lista',compact('cantMorosos','cantGrupos','cantInteres','cantAviso','cantClase'));
	}

	public function enviar_post(){
		$mailing 		= $this->mailingRepo->all();
		$pre_morosos 	= $this->personaRepo->allPreMorosos();
		$morosos 		= $this->personaRepo->allMorosos();
		$clases			= $this->claseRepo->allCancelado();;
		$interesCu 		= $this->personaRepo->allInteresCursoGrupo();
		$interesCa 		= $this->personaRepo->allInteresCarreraGrupo();
		$grupos 		= $this->grupoRepo->allNuevo();
		$personasMails 	= $this->personaMailRepo->allMailPersonaFilial();
		$filial = session('usuario')['entidad_id'];
		if ( count($clases) > 0 ){
			foreach ($clases as $c) {
				foreach ($c->Grupo->Matricula as $m) {
					if (isset($c->Grupo->Carrera->nombre)){
						$carrera = $c->Grupo->Carrera->nombre;
						$materia = $c->Grupo->Materia->nombre;
						$curso 	 = null;
					}
					else{
						$curso 	 = $c->Grupo->Curso->nombre;
						$carrera = null;
						$materia = null;	
					}
					foreach ($m->Persona->PersonaMail as $pm){
						$fecha 	   = $c->getFechaAttribute($c->fecha);
						$datosMail = array(	'nombre' 		=> $m->Persona->nombres,
				        					'apellido' 		=> $m->Persona->apellidos,
				        					'fecha' 		=> $fecha,
				        					'curso' 		=> $curso,
				        					'carrera' 		=> $carrera,
				        					'materia' 		=> $materia,
				        					'descripcion' 	=> $c->descripcion);
						// Envío del mail
						if ($this->mailingRepo->sendMail('mailing.claseCancelada', $datosMail, $pm->mail)){
							$dataMailing['persona_id'] 	 	 = $m->Persona->id;
							$dataMailing['filial_id'] 	 	 = $filial;
							$dataMailing['moroso'] 		 	 = 0;
							$dataMailing['enviado'] 	 	 = 1;
							$dataMailing['fecha_envio']  	 = date('Y-m-d');
							$this->mailingRepo->create($dataMailing);
							$flag[] = true;
						}
						else $flag[] = false;
					}
				}
				$claseModel = $this->claseRepo->find($c->id);
				$dataClase['enviado'] = 1;
				$this->claseRepo->edit($claseModel, $dataClase);
			}
		}

		if ( count($pre_morosos) > 0 ){
			foreach ($pre_morosos as $pre_moroso){
				$datosMail = array(	'nombre' 		=> $pre_moroso->nombres,
		        					'apellido' 		=> $pre_moroso->apellidos, 
		        					'nro_pago' 		=> $pre_moroso->nro_pago, 
		        					'matricula' 	=> $pre_moroso->matricula_id,
		        					'vencimiento' 	=> $pre_moroso->vencimiento);
				// Envío del mail
				if ($this->mailingRepo->sendMail('mailing.morososAviso', $datosMail, $pre_moroso->mail)){
					$dataMailing['persona_id'] 			= $pre_moroso->pe_id;
					$dataMailing['filial_id'] 			= $filial;
					$dataMailing['pago_id'] 			= $pre_moroso->pa_id;
					$dataMailing['moroso'] 				= 0;
					$dataMailing['enviado'] 			= 1;
					$dataMailing['vencimiento_pago'] 	= $pre_moroso->vencimiento;
					$dataMailing['fecha_envio'] 		= date('Y-m-d');
					$this->mailingRepo->create($dataMailing);
					$matricula = $this->matriculaRepo->find($pre_moroso->matricula_id);
					$dataMatricula['ultimo_mail_enviado'] = date('Y-m-d');
					$this->matriculaRepo->edit($matricula, $dataMatricula);
					$flag[] = true;
				}
				else $flag[] = false;
			}
		}
		
		if ( count($morosos) > 0 ) {
			foreach ($morosos as $moroso) {
				$datosMail = array(	'nombre' 		=> $moroso->nombres,
		        					'apellido' 		=> $moroso->apellidos, 
		        					'nro_pago' 		=> $moroso->nro_pago, 
		        					'matricula' 	=> $moroso->matricula_id,
		        					'vencimiento' 	=> $moroso->vencimiento,
		        					'recargo' 		=> $moroso->recargo);
				// Envío del mail
				if ($this->mailingRepo->sendMail('mailing.morosos', $datosMail, $moroso->mail)) {
					$dataMailing['persona_id'] 			= $moroso->pe_id;
					$dataMailing['filial_id'] 			= $filial;
					$dataMailing['pago_id'] 			= $moroso->pa_id;
					$dataMailing['moroso'] 				= 1;
					$dataMailing['enviado'] 			= 1;
					$dataMailing['vencimiento_pago'] 	= $moroso->vencimiento;
					$dataMailing['fecha_envio'] 		= date('Y-m-d');
					$this->mailingRepo->create($dataMailing);
					$matricula = $this->matriculaRepo->find($moroso->matricula_id);
					$dataMatricula['ultimo_mail_enviado'] = date('Y-m-d');
					$this->matriculaRepo->edit($matricula, $dataMatricula);
					$flag[] = true;
				}
				else $flag[] = false;
			}
		}

		if ( count($interesCu) > 0 ) {
			foreach ($interesCu as $iCu) {
				$datosMail = array(	'tipoInteres' 	=> 'Curso',
		        					'interes' 		=> $iCu->carrera,
		        					'duracion' 		=> $iCu->duracion);
				// Envío del mail
				if ($this->mailingRepo->sendMail('mailing.interes', $datosMail, $iCu->mail))
					$flag[] = true;
				else $flag[] = false;
			}
		}

		if ( count($interesCa) > 0 ) {
			foreach ($interesCa as $iCa) {
				$datosMail = array(	'tipoInteres' 	=> 'Carrera',
		        					'interes' 		=> $iCa->carrera,
		        					'duracion' 		=> $iCa->duracion);
				// Envío del mail
				if ($this->mailingRepo->sendMail('mailing.interes', $datosMail, $iCa->mail))
					$flag[] = true;
				else $flag[] = false;
			}
		}

		if ( count($grupos) > 0 ) {
			foreach ($personasMails as $personaMail){
				$data 					= array();
				$data['dataGrupos'] 	= serialize($grupos);
				if ($this->mailingRepo->sendMail('mailing.gruposNuevos', $data, $personaMail->mail)) {
					$dataMailing['persona_id'] 			= $personaMail->persona_id;
					$dataMailing['filial_id'] 			= $filial;
					$dataMailing['moroso'] 				= 0;
					$dataMailing['enviado'] 			= 1;
					$dataMailing['fecha_envio'] 		= date('Y-m-d');
					$this->mailingRepo->create($dataMailing);
					foreach ($grupos as $grupo) {
						$dataGrupo['nuevo'] = 0;
						$this->grupoRepo->edit($grupo, $dataGrupo);
					}
					$flag[] = true;
				}
				else $flag[] = false;
			}
		}

		if (in_array(false, $flag))
			return redirect()->back()->with('msg_error','Los mails no ha podido ser enviados, intente nuevamente en unos minutos.');
		else{
			return redirect()->back()->with('msg_ok','Los mails han sido enviados con éxito.');
		}

	}
}