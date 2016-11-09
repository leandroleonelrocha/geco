@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('carrera.editarcarrera')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.carreras_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>@lang('carrera.numero')</label>
								{!! Form::text(null, $carrera->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$carrera->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('carrera.nombre')</label>
								{!! Form::text('nombre', $carrera->nombre, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('carrera.duracion')</label>
								{!! Form::text('duracion', $carrera->duracion, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('carrera.descripcion')</label>
					     		{!! Form::textarea('descripcion',$carrera->descripcion,array('class'=>'form-control','size'=>'30x3')) !!}
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
@endsection