@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('preinforme.nuevopreinforme')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.preinformes_nuevaPersona_post', 'method'=>'post']) !!}
							<!-- ---------- Datos Personales ---------- -->
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
				            </div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M', null, array('class'=>'minimal')) !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F',  null, array('class'=>'minimal')) !!} @lang('persona.femenino')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.fnacimiento')</label>
								{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.domicilio')</label>
								{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.localidad')</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn-xs btn-success">+</button>	
								<div class="input_fields_telefono">
									{!! Form::text('telefono[]',null,array('class'=>'form-control')) !!}
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn-xs btn-success"">+</button>	
								<div class="input_fields_wrap">
							   		{!! Form::email('mail[]',null,array('class'=>'form-control')) !!}
								</div>	
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::text('nivel_estudios',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'minimal')) !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'minimal')) !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1', null, array('class'=>'minimal')) !!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1', null, array('class'=>'minimal')) !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1', null, array('class'=>'minimal')) !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1',  null, array('class'=>'minimal')) !!} @lang('persona.sabados')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.datospreinforme')</h4>
			              	</div>
			              	<div class="col-md-12 form-group">
								<label>@lang('persona.asesor')</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('preinforme.descripcion')</label>
								{!! Form::textarea('descripcion_preinforme',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Medio</label>
								{!! Form::textarea('medio',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.encontro')</label>
								{!! Form::textarea('como_encontro',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.intereses')</h4>
			              	</div>
			              	<div class="col-md-5 form-group">
								<label>@lang('preinforme.carreras')</label>
								{!! Form::select('carrera[]',$carreras->toArray(),null,array('id'=>'carreras', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-5 form-group">
								<label>@lang('preinforme.cursos')</label>
								{!! Form::select('curso[]',$cursos->toArray(),null,array('id'=>'cursos', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-2 form-group">
								<label>@lang('preinforme.ningunat')</label>
								<div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna','class'=>'minimal')) !!}</div>
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.otrost')</label>
								{!! Form::textarea('descripcion_interes',null,array('id'=>'otros', 'class' => 'form-control','disabled','size'=>'30x4')) !!}
							</div>
							<div class="box-footer col-xs-12">
								{!! Form::submit('Crear',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

