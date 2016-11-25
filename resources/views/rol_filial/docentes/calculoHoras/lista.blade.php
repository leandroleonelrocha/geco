@extends('template')

@section('content')

	<!-- Lista de Docentes -->
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Docente <strong>{{$docente->nombres}} {{$docente->apellidos}}</strong> </br>Busqueda de clases para saber las horas trabajadas</h3>	
				</div>
	
				{!! Form::open(['route'=> 'filial.docentes_calcularHorasBusqueda', 'method'=>'post']) !!}
				{!! Form::hidden('docente', $docente->id, array('class'=>'form-control')) !!}
				<div class="col-md-4 form-group">
					<label>Fecha Desde</label>
					{!! Form::date('fecha1',null,array('class'=>'form-control')) !!}
				</div>

				<div class="col-md-4 form-group">
					<label>Fecha Hasta</label>
					{!! Form::date('fecha2',null,array('class'=>'form-control')) !!}
				</div>

				<div class="col-md-9 form-group">
					{!! Form::submit('Buscar clase',array('class'=>'btn btn-success')) !!}
					<h3>Tiene {{$horasTotal}} horas de clases y {{$cantClases}} clases en total realizadas</h3>
				</div>
				{!! Form::close() !!}
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>Número de clase</th>
						<th>Fecha</th>
						<th>Horario desde</th>
						<th>Horario hasta</th>
						<th>Descripcion</th>

						</tr> </thead>
						<tbody>
							@foreach($clases as $c)
								<tr>
									<td>{{$c->id}}</td>
									<td>{{$c->fecha}}</td>
									<td>{{$c->horario_desde}}</td>
									<td>{{$c->horario_hasta}}</td>
									<td>{{$c->descripcion}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection