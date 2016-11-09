@extends('template')

@section('content')

	<!-- Lista de Docentes -->
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Examenes</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.examenes_nuevo')}}" class="btn btn-success text-white"> Agregar nuevo</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>Nro Acta</th>
				
						<th>Matricula</th>
						<th>Grupo</th>
						<th>Nota</th>
						<th>Docente</th>
						
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($examenes as $examen)
							<tr>
									<td>
										{{$examen->nro_acta}}
									</td>
									
									<td>{{$examen->Matricula->Persona->fullname}}</td>
									<td>{{$examen->Grupo->descripcion}}</td>
									<td>{{$examen->nota}}</td>
										
									<td>{{$examen->Docente->fullname}}</td>
										
								
									<td class="text-center">
									<a href="{{route('filial.examenes_editar',$examen->nro_acta)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>
									<a href="{{route('filial.examenes_borrar',$examen->nro_acta)}}" title="Borrar"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection