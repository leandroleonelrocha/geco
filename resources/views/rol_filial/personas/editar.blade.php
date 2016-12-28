@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('persona.editarpersona')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.personas_editar_post', 'method'=>'post']) !!}
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
				            </div>
				            {!! Form::hidden('persona', $persona->id, array('class'=>'form-control')) !!}
							<div class="col-md-6 form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),$persona->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.numerodocumento')</label>
								{!! Form::text('nro_documento',$persona->nro_documento,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',$persona->apellidos,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nombre')</label>
								{!! Form::text('nombres',$persona->nombres,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M',array('class'=>'flat-red')) !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F',array('class'=>'flat-red')) !!} @lang('persona.femenino')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.fnacimiento')</label>
								{!! Form::date('fecha_nacimiento',$persona->fecha_nacimiento,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-4 form-group">
								<label>@lang('persona.domicilio')</label>
								{!! Form::text('domicilio',$persona->domicilio,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-4 form-group">
								<label>@lang('persona.localidad')</label>
								{!! Form::text('localidad',$persona->localidad,array('class'=>'form-control')) !!}
							</div>

                        	<div class="col-md-4 form-group">
                                <label>@lang('filial.pais')</label>
                                {!! Form::select('pais_id', $paises->toArray() ,$persona->Pais->id, array('class'=>'form-control select2')) !!}
                            </div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',$persona->estado_civil,array('class'=>'form-control')) !!}
							</div>
							
								<div class="col-md-6 form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::select('nivel_estudios',['Secundario Completo' => 'Secundario Completo','Terciario' => 'Terciario','Universitario' => 'Universitario'],$persona->nivel_estudios,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computacion')</label>
								{!!Form::hidden('estudio_computacion', '0') !!}
								<div>{!! Form::checkbox('estudio_computacion', '1',$persona->estudio_computacion, array('class'=>'flat-red')) !!} @lang('persona.si')</div>

							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computadora')</label>
								{!!Form::hidden('posee_computadora', '0') !!}

								<div>{!! Form::checkbox('posee_computadora', '1',$persona->posee_computadora, array('class'=>'flat-red')) !!} @lang('persona.si')</div>

							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_manana', '0') !!}
									{!! Form::checkbox('disponibilidad_manana','1',$persona->disponibilidad_manana, array('class'=>'flat-red'))!!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_tarde', '0') !!}
									{!! Form::checkbox('disponibilidad_tarde', 'value',$persona->disponibilidad_tarde,array('class'=>'flat-red')) !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_noche', '0') !!}
									{!! Form::checkbox('disponibilidad_noche', '1',$persona->disponibilidad_noche,array('class'=>'flat-red')) !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_sabados', '0') !!}
									{!! Form::checkbox('disponibilidad_sabados','1', $persona->disponibilidad_sabados,array('class'=>'flat-red')) !!} @lang('persona.sabados')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',$persona->aclaraciones,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									@foreach ($telefono as $t)
										<input type="text" name="telefono[]" class="form-control" value="{{$t->telefono}}">
									@endforeach
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn btn-success">+</button>	
								<div class="input_fields_wrap">
									@foreach ($mail as $m)
										<input type="text" name="mail[]" class="form-control" value="{{$m->mail}}">
									@endforeach
								</div>	
							</div>

							<div class="box-footer col-xs-12">
					     		<button type="submit" class="btn btn-success">@lang('persona.guardar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection