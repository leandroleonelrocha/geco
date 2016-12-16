@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.nuevopersona')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
				            </div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
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
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M',null, array('class'=>'flat-red') ) !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F',null, array('class'=>'flat-red') ) !!} @lang('persona.femenino')
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
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::select('nivel_estudios',['Secundario Completo' => 'Secundario Completo','Terciario' => 'Terciario','Universitario' => 'Universitario'],null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1', null,array('class'=>'flat-red')) !!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1', null,array('class'=>'flat-red')) !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1', null,array('class'=>'flat-red')) !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1', null,array('class'=>'flat-red')) !!} @lang('persona.sabados')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									<input type="text" name="telefono[]" class="form-control">
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn btn-success">+</button>	
								<div class="input_fields_wrap">
							   		<input type="text" name="mail[]" class="form-control">
								</div>	
							</div>
						
						</div>
					</div>
					<div class="box-footer">
				     	<button type="submit" class="btn btn-success">@lang('persona.crear')</button>
		          	</div>
		          		{!! Form::close() !!}
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection


