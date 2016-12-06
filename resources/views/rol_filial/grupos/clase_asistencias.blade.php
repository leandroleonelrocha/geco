@extends('template')
@section('content')				
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de grupos</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('grupos.nuevo')}}" class="btn btn-success text-white"> Nuevo grupo</a>
						<a href="{{route('grupos.clases')}}" class="btn btn-success text-white"> Ver clases</a>
						
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead><tr>
							<th>Matr&iacute;cula</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Tipo de Documento</th>
							<th>Nro de Documento</th>
							<th>Asistencia</th>
						</tr></thead>
						<tbody>
							@foreach($matriculas as $matricula)
							<tr>
								<td>{{$matricula->id}}</td>
								<td>{{$matricula->Persona->nombres}}</td>
								<td>{{$matricula->Persona->apellidos}}</td>
								<td>{{$matricula->Persona->TipoDocumento->tipo_documento}}</td>
								<td>{{$matricula->Persona->nro_documento}}</td>
								<td class="text-center">
									<input class="asistencia" data-clase="{{$id}}" data-matricula="{{$matricula->id}}" data-url="{{route('grupos.clase_asistir')}}" type="checkbox">
								</td>
							</tr>				
							@endforeach
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection