@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('docente.nuevodocente')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.docentes_nuevo_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								<label>@lang('docente.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.descripcion')</label>
								{!! Form::textarea('descripcion',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.disponibilidad')</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1') !!} @lang('docente.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1') !!} @lang('docente.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1') !!} @lang('docente.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1') !!} @lang('docente.sabados')
								</div>
							</div>
							<div class="box-footer col-xs-12">
					     		<button type="submit" class="btn btn-success">@lang('docente.crear')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection