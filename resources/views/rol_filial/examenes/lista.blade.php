@extends('template')

@section('content')
							
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listaso de grupos</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.examenes_nuevo')}}" class="btn btn-success text-white"> Nuevo acta</a>
						
						
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> 
						<tr>
						<th>Nro acta</th>
						<th>Grupo</th>
						<th>Docente</th>
					
						<th></th>
						
						</tr> 
						</thead>
						<tbody>
						   @foreach($examenes as $examen)
						   		
							    <tr role="row" class="odd">

							        <td class="sorting_1">{{ $examen->nro_acta }}</td>
						        	<td>{{ $examen->Grupo->fullname}}</td>
						        	<td>{{ $examen->Docente->fullname }}</td>
						       
						           
						  			<td class="text-center">
					           		<a href="{{route('filial.examenes_detalles',$examen->nro_acta)}}" title="Editar"><i class="glyphicon glyphicon-info-sign"></i></a>		
								
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
