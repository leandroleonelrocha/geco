@extends('template')

@section('content')
									<!-- Lista de Matrículas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Matr&iacute;culas</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.matriculas_seleccion')}}" class="btn btn-success text-white"> Agregar nueva</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>N&uacute;mero de Matr&iacute;cula</th>
						<th>Asesor</th>
						<th>Persona</th>
						<th>Terminado</th>
						<th>Cancelado</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($matriculas as $matricula)
							<tr>
								<td>{{$matricula->id}}</td>
								<td>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</td>
								<td>{{$matricula->Persona->apellidos}} {{$matricula->Persona->nombres}}</td>
								<td>
									<?php if($matricula->terminado == 0) echo 'No'; else echo 'Si';?>
								</td>
								<td>
									<?php if($matricula->cancelado == 0) echo 'No'; else echo 'Si';?>
								</td>
								<td class="text-center">
								<a href="{{route('filial.matriculas_vista',$matricula->id)}}" title="Vista Detallada"><i class="btn btn-info glyphicon glyphicon-search"></i></a>
								<a href="{{route('filial.matriculas_editar',$matricula->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>
								<a href="{{route('filial.matriculas_actualizar',$matricula->id)}}" title="Actualizar"><i class="btn btn-primary glyphicon glyphicon-repeat"></i></a>
								<a href="{{route('filial.matriculas_borrar',$matricula->id)}}" title="Borrar"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
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