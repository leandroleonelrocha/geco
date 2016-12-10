@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.nuevoasesor')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
						
							{!! Form::open(['route'=> 'filial.asesores_nuevo_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								<label>@lang('asesor.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.direccion')</label>
								{!! Form::text('direccion',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.localidad')</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.telefonos')</label>
								<button class="add_input_telefono btn-xs btn-success">+</button>	
								<div class="input_fields_telefono">
									<input type="text" name="telefono[]" class="form-control">
								</div>
							</div>

							<div class="col-md-6 form-group">	
								<label>@lang('asesor.mail')</label>
								<button class="add_input_mail btn-xs btn-success"">+</button>	
								<div class="input_fields_wrap">
									<input type="text" name="mail[]" class="form-control">
								</div>	
							</div>
		
							<div class="box-footer col-xs-12">
						     <button type="submit" class="btn btn-success">@lang('asesor.crear')</button>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection


