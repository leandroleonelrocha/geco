@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.editarasesor')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.asesores_editar_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								{!! Form::hidden('asesor', $asesor->id, array('class'=>'form-control')) !!}
								<label>@lang('asesor.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),$asesor->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.numerodocumento')</label>
								{!! Form::text('nro_documento', $asesor->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.apellido')</label>
								{!! Form::text('apellidos', $asesor->apellidos, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.nombre')</label>
								{!! Form::text('nombres', $asesor->nombres, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.direccion')</label>
								{!! Form::text('direccion', $asesor->direccion, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.localidad')</label>
								{!! Form::text('localidad', $asesor->localidad, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
								@foreach ($telefono as $t)
									{!! Form::text('telefono[]', $t->telefono, array('class'=>'form-control')) !!}
								@endforeach
								</div>
							</div>

							<div class="col-md-6 form-group">	
								<label>@lang('asesor.mail')</label>
								<button class="add_input_mail btn btn-success"">+</button>	
								<div class="input_fields_wrap">
				   					@foreach ($mail as $m)
										{!! Form::email('mail[]',$m->mail , array('class'=>'form-control')) !!}
									@endforeach
								</div>	
							</div>

							<div class="box-footer col-xs-12">
                            <button type="submit" class="btn btn-success">@lang('asesor.guardar') </button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
