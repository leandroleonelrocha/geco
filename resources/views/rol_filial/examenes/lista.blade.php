@extends('template')

@section('content')
							
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('examen.listadoacta')</h3>
					<div class="box-tools pull-right no-print">
<<<<<<< HEAD
						<a href="{{route('filial.examenes_nuevo')}}" class="btn btn-success text-white"> @lang('examen.nuevaacta')</a>
						
						
=======
						<a href="{{route('filial.examenes_nuevo')}}" class="btn btn-success text-white"> Nuevo acta</a>	
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
					</div>
				</div>
				@if(count($examenes) > 0)
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
<<<<<<< HEAD
						<thead> 
						<tr>
						<th>@lang('examen.numeroacta')</th>
						<th>@lang('grupo.grupo')</th>
						<th>@lang('grupo.docente')</th>
					
						<th></th>
						
						</tr> 
						</thead>
=======
						<thead><tr>
							<th>Nro acta</th>
							<th>Grupo</th>
							<th>Docente</th>
							<th></th>
						</tr></thead>
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
						<tbody>
						   @foreach($examenes as $examen)
							    <tr role="row" class="odd">
							        <td class="sorting_1">{{ $examen->nro_acta }}</td>
						        	<td>@if(isset($examen->Grupo)) {{$examen->Grupo->fullname}} @endif</td>
						        	<td>{{ $examen->Docente->fullname }}</td>
						  			<td class="text-center">
<<<<<<< HEAD
					           		<a href="{{route('filial.examenes_detalles',$examen->nro_acta)}}" title="@lang('lista.editar')"><i class="glyphicon glyphicon-primary-sign"></i></a>		
								
=======
					           		<a href="{{route('filial.examenes_detalles',$examen->nro_acta)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>	
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
					           		</td>
							    </tr>
						    @endforeach
						
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
        		@endif
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
