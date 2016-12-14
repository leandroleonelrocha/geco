@extends('template')

@section('content')
		
						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.misasesores')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.asignacionAsesores_nuevo')}}" class="btn btn-success text-white"> @lang('asesor.seleccion')</a>
					</div>
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
					    		<td>{{ $a->asesor_id}}</td>
					    		<td>{{ $a->Asesor->nro_documento}}</td>
					    		<td>{{ $a->Asesor->apellidos}}</td>
								<td>{{ $a->Asesor->nombres}}</td>
				    		   	<td>

					           		<a href="{{route('filial.asignacionAsesores_borrar',$a->asesor_id)}}" title="@lang('lista.eliminar')" class="btn-xs btn-danger glyphicon glyphicon-remove"></a></td>
						    </tr>
					    @endforeach
						    	        
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection