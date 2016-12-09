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
						<thead> 
						<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Descripción</th>
						
						<th>Docente</th>
						<th></th>
						
						</tr> 
						</thead>
						<tbody>
						@foreach($grupos as $grupo)
						<tr>
						<td>
							<small class="label" style="background-color: {{$grupo->color}} "><i class="fa fa-users"></i></small>
						</td>
						<td> 
							<?php if(isset($grupo->Curso->nombre)) echo $grupo->Curso->nombre ; ?>
							<?php if(isset($grupo->Carrera->nombre)) echo $grupo->Carrera->nombre . ', ';  ?>
							<?php if(isset($grupo->Materia->nombre)) echo $grupo->Materia->nombre ?>
						</td>
						<td>{{ $grupo->descripcion }}</td>
						<td>{{ $grupo->Docente->fullname }}</td>	
						   	<td class="text-center">
					           		<a href="{{route('grupos.edit',$grupo->id)}}" title="Editar"><i class="btn-xs btn-success glyphicon glyphicon-pencil"></i></a>	
					           		<a href="{{route('grupos.grupos_borrar',$grupo->id)}}" title="Borrar"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a>
							</td>
							   
						</tr>					
						@endforeach
					    	
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<div class="row">
        <div class="col-sm-12">
	        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
	        	{!! $grupos->render() !!}
	        </div>
        </div>
    </div>
@endsection

 