@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Editar Asesor</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.asesores_editar_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								{!! Form::hidden('asesor', $asesor->id, array('class'=>'form-control')) !!}
								<label>Tipo de Documento</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),$asesor->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>N&uacute;mero de Documento</label>
								{!! Form::text('nro_documento', $asesor->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Apellido</label>
								{!! Form::text('apellidos', $asesor->apellidos, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nombres</label>
								{!! Form::text('nombres', $asesor->nombres, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Direcci&oacute;n</label>
								{!! Form::text('direccion', $asesor->direccion, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Localidad</label>
								{!! Form::text('localidad', $asesor->localidad, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Tel&eacute;fono</label>
								@foreach ($telefono as $t)
									{!! Form::text('telefono[]', $t->telefono, array('class'=>'form-control')) !!}		
								@endforeach
							</div>

							<div class="col-md-6 form-group">
								<label>E-Mail</label>
								@foreach ($mail as $m)
									{!! Form::email('mail[]',$m->mail , array('class'=>'form-control')) !!}
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