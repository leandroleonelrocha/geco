@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Editar persona</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.personas_editar_post', 'method'=>'post']) !!}

					    	<div class="col-md-12 form-group">
		    					{!! Form::hidden('persona', $persona->id, array('class'=>'form-control')) !!}
								<label>Asesor</label>
								{!! Form::select('asesor_id',$asesores->toArray(),$persona->Asesor->id,array('class' => 'form-control')) !!}
							</div>
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">Datos Personales</h4>
				            </div>

							<div class="col-md-6 form-group">
								<label>Tipo de Documento</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),$persona->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>N&uacute;mero de Documento</label>
								{!! Form::text('nro_documento',$persona->nro_documento,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Apellido</label>
								{!! Form::text('apellidos',$persona->apellidos,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nombre</label>
								{!! Form::text('nombres',$persona->nombres,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>G&eacute;nero</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M') !!} Masculino
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F') !!} Femenino
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Fecha de Nacimiento</label>
								{!! Form::date('fecha_nacimiento',$persona->fecha_nacimiento,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Domicilio</label>
								{!! Form::text('domicilio',$persona->domicilio,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Localidad</label>
								{!! Form::text('localidad',$persona->localidad,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Tel&eacute;fono</label>
								@foreach ($telefono as $t)
									{!! Form::text('telefono',$t->telefono,array('class'=>'form-control')) !!}
								@endforeach
							</div>
							<div class="col-md-6 form-group">
								<label>E-mail</label>
								@foreach ($mail as $m)
									{!! Form::email('mail',$m->mail,array('class'=>'form-control')) !!}
								@endforeach
							</div>
							<div class="col-md-6 form-group">
								<label>Estado Civil</label>
								{!! Form::text('estado_civil',$persona->estado_civil,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nivel de Estudios</label>
								{!! Form::text('nivel_estudios',$persona->nivel_estudios,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Estudios de Computaci&oacute;n</label>
								{!!Form::hidden('estudio_computacion', '0') !!}
								<div>{!! Form::checkbox('estudio_computacion', '1',$persona->estudio_computacion) !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Posee Computadoras</label>
								{!!Form::hidden('posee_computadora', '0') !!}
								<div>{!! Form::checkbox('posee_computadora', '1',$persona->posee_computadora) !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Disponibilidad</label>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_manana', '0') !!}
									{!! Form::checkbox('disponibilidad_manana','1',$persona->disponibilidad_manana)!!} Ma&ntilde;ana
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_tarde', '0') !!}
									{!! Form::checkbox('disponibilidad_tarde', 'value',$persona->disponibilidad_tarde) !!} Tarde
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_noche', '0') !!}
									{!! Form::checkbox('disponibilidad_noche', '1',$persona->disponibilidad_noche) !!} Noche
								</div>
								<div class="col-xs-12">
								 	{!!Form::hidden('disponibilidad_sabados', '0') !!}
									{!! Form::checkbox('disponibilidad_sabados','1', $persona->disponibilidad_sabados) !!} S&aacute;bados
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Aclaraciones</label>
								{!! Form::textarea('aclaraciones',$persona->aclaraciones,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="box-footer col-xs-12">
								{!! Form::submit('Guardar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<!-- jQuery 2.1.4 -->
@endsection