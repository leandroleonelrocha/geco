@extends('template')

@section('content')

	<!-- Lista de Docentes -->
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('docente.listadodocente')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.docentes_nuevo')}}" class="btn btn-success text-white"> @lang('docente.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('docente.documento')</th>
						<th>@lang('docente.nombre')</th>	
						<th>@lang('docente.descripcion')</th>				
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($docentes as $docente)
							<tr>
									<td>
										<input type="hidden" value="{{$docente->id}}">
										{{ $docente->TipoDocumento->tipo_documento}} {{$docente->nro_documento}}
										
									</td>
									<td>{{$docente->apellidos }} {{ $docente->nombres }}</td>
									<td>{{$docente->descripcion}}</td>
									
									<td class="text-center">

									<a href="{{route('filial.docentes_editar',$docente->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
									<a href="{{route('filial.docentes_borrar',$docente->id)}}" title="@lang('lista.eliminar')"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a>
									<a href="{{route('filial.docentes_calcularHoras',$docente->id)}}" title="@lang('lista.horas')"><i class="btn-xs btn-info glyphicon glyphicon-time"></i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->

@endsection