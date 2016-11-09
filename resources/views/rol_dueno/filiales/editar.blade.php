@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Editar Filial</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'dueño.filiales_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>N&uacute;mero</label>
								{!! Form::text(null, $filial->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$filial->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>Nombre</label>
								{!! Form::text('nombre', $filial->nombre, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Direcci&oacuten</label>
								{!! Form::text('direccion', $filial->direccion, array('class'=>'form-control')) !!}
							</div>


							<div class="col-md-6 form-group">
								<label>Localidad</label>
			     				{!! Form::text('localidad', $filial->localidad, array('class'=>'form-control')) !!}
							</div>

					        <div class="col-md-6 form-group">
                                <label>C&oacute;digo postal</label>
                               		{!! Form::text('codigo_postal', $filial->codigo_postal, array('class'=>'form-control')) !!}
							</div>

                            <div class="col-md-6 form-group">
                                <label>Tel&eacute;fono</label>
								@foreach ($telefono as $t)
									{!! Form::text('telefono', $t->telefono, array('class'=>'form-control')) !!}		
								@endforeach
                            </div>

							<div class="col-md-6 form-group">
								<label>Director</label>
     				            {!! Form::select('director_id', $directores->toArray() , $filial->Director->id, array('class'=>'form-control')) !!}
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