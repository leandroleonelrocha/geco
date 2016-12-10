@extends('template')

@section('content')
							
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">

					<h3 class="box-title">@lang('examen.listadoexamen')</h3>
					<div class="box-tools pull-right no-print">
					
						
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> 
						<tr>
						<th>@lang('examen.matricula') </th>
						<th>@lang('examen.nombre') </th>
						<th>@lang('examen.nota') </th>
						<th>@lang('examen.recupertorio') </th>
								
					
						
						</tr> 
						</thead>
						<tbody>
							<?php $count = 0; ?>
						   @foreach($examenes as $examen)
							    <tr role="row" class="odd">
							        <td class="sorting_1">{{ $examen->matricula_id }}</td>
						        	<td>{{$examen->Matricula->Persona->fullname }}</td>
						        	<td>{{$examen->nota }}</td>
						        	<td>
						   				<?php 
						   					if( $maxNota[$count] != 0) echo $maxNota[$count];
						   					else echo '-';
						   				?>
						        	</td>
						        	<td class="text-center">
					           		<a href="{{route('filial.examenes_recuperatorio',$examen->id)}}" title="Recuperatorio"><i class="btn btn-success glyphicon glyphicon-refresh"></i></a>	
					           		</td>
							    </tr>
								<?php $count++; ?>
						    @endforeach
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de recuperatorios</h3>
					<div class="box-tools pull-right no-print">		
					</div>
				</div>
				<div class="box-body">
					<table id="example2" class="table table-bordered table-striped">
						<thead><tr>
							<th>Matricula</th>
							<th>Nombre </th>
							<th>Nota </th>
						</tr></thead>
						<tbody>
						   @for($i=0; $i < count($recuperartorios); $i++)
							   @foreach($recuperartorios[$i] as $recuperartorio)
								    <tr role="row" class="odd">
								        <td class="sorting_1">{{ $recuperartorio->matricula_id }}</td>
							        	<td>{{$recuperartorio->Matricula->Persona->fullname }}</td>
							        	<td>{{$recuperartorio->nota }}</td>
								    </tr>
							    @endforeach
						    @endfor
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection