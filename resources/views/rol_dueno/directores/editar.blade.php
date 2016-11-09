@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Editar director</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'dueño.directores_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>N&uacute;mero director</label>
								{!! Form::text(null, $director->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$director->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>Tipo de documento</label>
     				      		{!! Form::select('tipo_documento_id',$tipos->toArray(),$director->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Nro Documento</label>
								{!! Form::text('nro_documento', $director->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Apellido</label>
								{!! Form::text('apellidos', $director->apellidos, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Nombres</label>
								{!! Form::text('nombres', $director->nombres, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Tel&eacute;fono</label>
								@foreach ($telefono as $t)
									{!! Form::text('telefono', $t->telefono, array('class'=>'form-control')) !!}		
								@endforeach
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