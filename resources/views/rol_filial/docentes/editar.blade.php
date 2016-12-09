@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('docente.editardocente')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.docentes_editar_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								{!! Form::hidden('docente', $docente->id, array('class'=>'form-control')) !!}
								<label>@lang('docente.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),$docente->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.numerodocumento')</label>
								{!! Form::text('nro_documento', $docente->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.apellido')</label>
								{!! Form::text('apellidos', $docente->apellidos, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.nombre')</label>
								{!! Form::text('nombres', $docente->nombres, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.descripcion')</label>
								{!! Form::textarea('descripcion', $docente->descripcion, array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('docente.disponibilidad')</label>
								<div class="col-xs-12">
									{!!Form::hidden('disponibilidad_manana', '0') !!}
									{!! Form::checkbox('disponibilidad_manana','1', $docente->disponibilidad_manana, array('class'=>'minimal')) !!} @lang('docente.mañana')
								</div>
								<div class="col-xs-12">
									{!!Form::hidden('disponibilidad_tarde', '0') !!}
									{!! Form::checkbox('disponibilidad_tarde','1', $docente->disponibilidad_tarde,array('class'=>'minimal')) !!} @lang('docente.tarde')
								</div>
								<div class="col-xs-12">
									{!!Form::hidden('disponibilidad_noche', '0') !!}
									{!! Form::checkbox('disponibilidad_noche','1', $docente->disponibilidad_noche, array('class'=>'minimal')) !!} @lang('docente.noche')
								</div>
								<div class="col-xs-12">
									{!!Form::hidden('disponibilidad_sabados', '0') !!}
									{!! Form::checkbox('disponibilidad_sabados', '1', $docente->disponibilidad_sabados,array('class'=>'minimal')) !!} @lang('docente.sabados')
								</div>
							</div>
							<div class="box-footer col-xs-12">
					     		<button type="submit" class="btn btn-success">@lang('docente.guardar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection