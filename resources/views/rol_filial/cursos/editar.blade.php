@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Editar Curso</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.cursos_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>N&uacute;mero</label>
								{!! Form::text(null, $curso->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$curso->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>Nombre</label>
								{!! Form::text('nombre', $curso->nombre, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Duraci&oacuten</label>
								{!! Form::text('duracion', $curso->duracion, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Descripci&oacuten</label>
					     		{!! Form::textarea('descripcion',$curso->descripcion,array('class'=>'form-control','size'=>'30x3')) !!}
							</div>

							<div class="col-md-8 form-group">
	 				         <div class="col-xs-1"><label>Taller</label></div>
                                <div class="col-xs-11">
		                            {!!Form::hidden('taller', '0') !!}
		                            {!! Form::checkbox('taller','1')!!}
                                </div>
						
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