@extends('template')


@section('content')
	
								
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listaso de grupos</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('grupos.nuevo')}}" class="btn btn-success text-white"> Nuevo grupo</a>
						<a href="{{route('grupos.clases')}}" class="btn btn-success text-white"> Ver clases</a>
						
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> 
						<tr>
						<th>Curso</th>
						<th>Carrera</th>
						<th>Materia</th>
						<th>Descripcion</th>
						<th>Docente</th>
						<th></th>
						
						</tr> 
						</thead>
						<tbody>
						@foreach($grupos as $grupo)
						<tr>
						<td> <?php if(isset($grupo->Curso->nombre)) echo $grupo->Curso->nombre; ?></td>
						<td><?php if(isset($grupo->Carrera->nombre)) echo $grupo->Carrera->nombre ?></td>
						<td><?php if(isset($grupo->Materia->nombre)) echo $grupo->Materia->nombre ?></td>
						<td>{{ $grupo->descripcion }}</td>
						<td>{{ $grupo->Docente->fullname }}</td>	
						   	<td class="text-center">
					           		<a href="{{route('grupos.edit',$grupo->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>	
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

 