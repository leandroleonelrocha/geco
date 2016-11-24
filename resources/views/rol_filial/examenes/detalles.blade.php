@extends('template')

@section('content')
							
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de examenes</h3>
					<div class="box-tools pull-right no-print">
					
						
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> 
						<tr>
						<th>Matricula</th>
						<th>Nombre </th>
						<th>Nota </th>
						<th>Recuperatorio </th>
								
					
						
						</tr> 
						</thead>
						<tbody>
						   @foreach($examenes as $examen)
						   		
							    <tr role="row" class="odd">

							        <td class="sorting_1">{{ $examen->matricula_id }}</td>
						        	<td>{{$examen->Matricula->Persona->fullname }}</td>
						        	<td>{{$examen->nota }}</td>
						        	<td>Recuperatorio nota</td>
							    </tr>
						    @endforeach
						
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection