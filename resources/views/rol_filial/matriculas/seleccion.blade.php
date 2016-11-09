@extends('template')

@section('content')
									<!-- Mensaje -->
	<div class="row">
	@if (session()->has('msg_ok'))
	    <div class="col-xs-10 col-md-offset-1 alert alert-success">
	        <strong>Éxito!</strong><br />
	        {{ session('msg_ok') }}
	    </div>
	@endif
	@if (session()->has('msg_error'))
	    <div class="col-xs-10 col-md-offset-1 alert alert-danger">
	        <strong>Error!</strong><br />
	        {{ session('msg_error') }}
	    </div>
	@endif
	</div>
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Personas</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.matriculas_nuevaPersona')}}" class="btn btn-success text-white"> Agregar nueva Persona</a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-xs-12">
						<div class="col-xs-9">
			            	<h4 class="box-title">
			            		Personas Existentes
			            		<div><small>Seleccione una persona o cree un preinforme con una persona nueva</small></div>
			            	</h4>
			            </div>
						<table id="example1" class="table table-bordered table-striped">
							<thead><tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>N&uacute;mero de Documento</th>
							<th class="no-print"></th>
							</tr></thead>
							<tbody>
								@foreach($personas as $persona)
										<tr>
											<td>{{$persona->nombres}}</td>
											<td>{{$persona->apellidos}}</td>
											<td>{{$persona->nro_documento}}</td>
											<td class="text-center"><a href="{{route('filial.matriculas_nuevo',$persona->id)}}" class="btn btn-success text-white">Seleccionar</a></td>
										</tr>
								@endforeach
							</tbody>
						</table>	
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection