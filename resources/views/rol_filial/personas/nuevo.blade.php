@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Alta de persona</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}

					    	<div class="col-md-12 form-group">
								<label>Asesor</label>
								{!! Form::select('asesor_id',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">Datos Personales</h4>
				            </div>

							<div class="col-md-6 form-group">
								<label>Tipo de Documento</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>N&uacute;mero de Documento</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Apellido</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nombre</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
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
								{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Domicilio</label>
								{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Localidad</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Estado Civil</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nivel de Estudios</label>
								{!! Form::text('nivel_estudios',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Estudios de Computaci&oacute;n</label>
								<div>{!! Form::checkbox('estudio_computacion', '1') !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Posee Computadoras</label>
								<div>{!! Form::checkbox('posee_computadora', '1') !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Disponibilidad</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1') !!} Ma&ntilde;ana
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1') !!} Tarde
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1') !!} Noche
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1') !!} S&aacute;bados
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>Aclaraciones</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="col-md-6 form-group telefono">
								<label>Tel&eacute;fono</label>
								<div class="btn btn-default agregar" data-info="telefono">+</div>
								{!! Form::text('telefono[]',null,array('class'=>'form-control item')) !!}
								<div class="btn btn-default quitar" data-info="telefono">-</div>
							</div>
							<div class="col-md-6 form-group mail">
								<label>E-mail</label>
								<div class="btn btn-default agregar" data-info="mail">+</div>
								{!! Form::email('mail[]',null,array('class'=>'form-control')) !!}
								<div class="btn btn-default quitar" data-info="mail">-</div>
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
	<!-- jQuery 2.1.4 -->
	<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/functions/functions.js')}}"></script>
@endsection