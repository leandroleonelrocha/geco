@extends('template')

@section('content')
							
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('examen.listadoacta')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.examenes_nuevo')}}" class="btn btn-success text-white"> @lang('examen.nuevaacta')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead><tr>
							<th>@lang('examen.numeroacta')</th>
							<th>@lang('grupo.grupo')</th>
							<th>@lang('grupo.docente')</th>
							<th></th>
						</tr></thead>
						<tbody>
						   @foreach($examenes as $examen)
						   		@if($examen->Grupo->filial_id == $filial)
						   		
							    <tr role="row" class="odd">
							        <td class="sorting_1">{{ $examen->nro_acta }}</td>
						        	<td>@if(isset($examen->Grupo)) {{$examen->Grupo->fullname}} @endif</td>
						        	<td>{{ $examen->Docente->fullname }}</td>

					           		<td class="text-center">
					           		<a href="{{route('filial.examenes_detalles',$examen->nro_acta)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>	
					           		</td>
							    </tr>
							    @endif
						    @endforeach
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
