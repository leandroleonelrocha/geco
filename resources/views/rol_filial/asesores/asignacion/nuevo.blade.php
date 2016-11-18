@extends('template')

@section('content')
		
						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.titulo')</h3>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('asesor.numeroasesor')</th>
						<th>@lang('asesor.numerodocumento')</th>
						<th>@lang('asesor.apellido')</th>
						<th>@lang('asesor.nombre')</th>

			
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($asesor as $a)
							    <tr role="row" class="odd">
						    	   	<td>{{ $a->id}}</td>
							      	<td>{{ $a->nro_documento}}</td>
							        <td>{{ $a->apellidos }}</td>
							        <td>{{ $a->nombres }}</td>
							        <td class="text-center"><a href="{{route('filial.asignacionAsesores_nuevo_post',$a->id)}}" title="Asignar" class="btn btn-success glyphicon glyphicon-ok"></a></td>
							    </tr> 
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection