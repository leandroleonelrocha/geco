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
// use Mail;

class MailingController extends Controller
{
	protected $cursoRepo;

	public function __construct(FilialRepo $filialRepo, MailingRepo $mailingRepo, PagoRepo $pagoRepo, PersonaRepo $personaRepo, PersonaMailRepo $personaMailRepo, GrupoRepo $grupoRepo, MatriculaRepo $matriculaRepo)
	{
		$this->filialRepo 		= 	$filialRepo;
		$this->mailingRepo 		= 	$mailingRepo;
		$this->pagoRepo 		= 	$pagoRepo;
		$this->personaRepo 		= 	$personaRepo;
		$this->personaMailRepo 	= 	$personaMailRepo;
		$this->grupoRepo 		= 	$grupoRepo;
		$this->matriculaRepo 	= 	$matriculaRepo;
	}
	
	public function lista(){
		$cantMorosos 	= count($this->personaRepo->allMorosos());
		$cantInteres 	= count($this->personaRepo->allInteresCursoGrupo()) + count($this->personaRepo->allInteresCarreraGrupo());
		if ( count($this->grupoRepo->allNuevo()) >0 )
			$cantGrupos 	= count($this->personaMailRepo->allMailPersonaFilial());
		else
			$cantGrupos 	= 0;

		return view('rol_filial.mails.lista',compact('cantMorosos','cantGrupos','cantInteres'));
	}

	public function enviar_post(){
		$mailing 		= $this->mailingRepo->all();
		$morosos 		= $this->personaRepo->allMorosos();
		$interesCu 		= $this->personaRepo->allInteresCursoGrupo();
		$interesCa 		= $this->personaRepo->allInteresCarreraGrupo();
		$grupos 		= $this->grupoRepo->allNuevo();
		$personasMails 	= $this->personaMailRepo->allMailPersonaFilial();
		
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
					$dataMailing['filial_id'] 			= session('usuario')['entidad_id'];
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
		// if ( count($interes) > 0 ) {}

		if ( count($grupos) > 0 ) {
			foreach ($personasMails as $personaMail){
				$data 					= array();
				$data['dataGrupos'] 	= serialize($grupos);
				if ($this->mailingRepo->sendMail('mailing.gruposNuevos', $data, $personaMail->mail)) {
					$dataMailing['persona_id'] 			= $personaMail->persona_id;
					$dataMailing['filial_id'] 			= session('usuario')['entidad_id'];
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