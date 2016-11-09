@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Modificar Matr&iacute;cula</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
						<?php foreach ($grupos as $grupo){
							} ?>
							{!! Form::open(['route'=> 'filial.matriculas_editar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">Datos de la Matr&iacute;cula</h4>
			              	</div>
			              	<div class="col-md-6 form-group">
								<label>Asesor</label>
								{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control')) !!}
								{!! Form::select('asesor',$asesores->toArray(),$matricula->Asesor->id,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>Carreras y Cursos</label>
								<select name="carreras_cursos" class="form-control">
									<optgroup label="Carreras">
										@foreach($carreras as $carrera)
											<option value="carrera;{{$carrera->id}}" <?php if($matricula->carrera_id == $carrera->id) echo 'selected' ?>>
												{{$carrera->nombre}}
											</option>
										@endforeach
									</optgroup>
									<optgroup label="Cursos">
										@foreach($cursos as $curso)
											<option value="curso;{{$curso->id}}" <?php if($matricula->curso_id == $curso->id) echo 'selected' ?>>
												{{$curso->nombre}}
											</option>
										@endforeach
									</optgroup>
								</select>
							</div>
										<!-- ---------- Plan de Pagos ---------- -->
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">Plan de Pagos</h4>
			                	<div>Acontinuaci&oacute;n cargue cada uno de los pagos que conformar&aacute;n el plan.</div>
			              	</div>
							<div id="planDePagos">
							@foreach($pagos as $pago)
								<div class="pagos">
					              	<div class="col-md-6 form-group">
										<label>N&uacute;mero de Pago</label>
										{!! Form::text('nro_pago[]',$pago->nro_pago,array('class'=>'pago-item form-control')) !!}
									</div>
									<div class="col-md-6 form-group">
										<label>Fecha de Vencimiento</label>
										{!! Form::date('vencimiento[]',$pago->vencimiento,array('class'=>'pago-item form-control')) !!}
									</div>
									<div class="col-md-6 form-group">
										<label>Monto a Pagar</label>
										<div class="input-group">
			  								<span class="input-group-addon">$</span>
											{!! Form::text('monto_original[]',$pago->monto_original,array('class'=>'pago-item form-control')) !!}
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label>Recargo</label>
										<div class="input-group">
			  								<span class="input-group-addon">$</span>
											{!! Form::text('recargo[]',$pago->recargo,array('class'=>'pago-item form-control')) !!}
			  							</div>
									</div>
									<div class="col-md-12 form-group">
										<label>Descripci&oacute;n</label>
										{!! Form::textarea('descripcion[]',$pago->descripcion,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
										<div class="line"></div>
									</div>
								</div><!-- Fin pagos -->
							@endforeach
							</div><!-- Fin planDePagos -->
							<div class="box-footer col-xs-12">
								{!! Form::submit('Modificar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/functions/functions.js')}}"></script>
@endsection