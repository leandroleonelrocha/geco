@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('materia.editarmateria')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.materias_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>@lang('materia.numero')</label>
								{!! Form::text(null, $materia->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$materia->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('materia.carrera')</label>
  								{!! Form::select('carrera_id', $carreras->toArray() , $materia->Carrera->id, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('materia.nombre')</label>
								{!! Form::text('nombre', $materia->nombre, array('class'=>'form-control')) !!}
							</div>


							<div class="col-md-6 form-group">
								<label>@lang('Descripcion')</label>
					     		{!! Form::textarea('descripcion',$materia->descripcion,array('class'=>'form-control','size'=>'30x3')) !!}
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