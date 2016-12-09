@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('curso.editarcurso')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.cursos_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<input type="hidden" name="id" value="{{$curso->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('curso.nombre')</label>
								{!! Form::text('nombre', $curso->nombre, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('curso.duracion')</label>
								{!! Form::text('duracion', $curso->duracion, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('curso.descripcion')</label>
					     		{!! Form::textarea('descripcion',$curso->descripcion,array('class'=>'form-control','size'=>'30x3')) !!}
							</div>

							<div class="col-md-3 form-group">
	 				         <label>@lang('curso.taller')</label>
		                            {!!Form::hidden('taller', '0') !!}
		                            {!! Form::checkbox('taller','1')!!}
							</div>
							<div class="box-footer col-xs-12">
							<button type="submit" class="btn btn-success">@lang('curso.guardar') </button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection