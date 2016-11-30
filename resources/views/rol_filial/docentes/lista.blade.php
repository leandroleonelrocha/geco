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
						<th>@lang('docente.tipodocumento')</th>
						<th>@lang('docente.numerodocumento')</th>
						<th>@lang('docente.apellido')</th>
						<th>@lang('docente.nombre')</th>					
						<th>@lang('docente.disponibilidad')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($docentes as $docente)
							<tr>
									<td>
										<input type="hidden" value="{{$docente->id}}">
										{{$docente->TipoDocumento->tipo_documento}}
										
									</td>
									<td>{{$docente->nro_documento}}</td>
									<td>{{$docente->apellidos}}</td>
									<td>{{$docente->nombres}}</td>
									
						         	<td><?php if($docente->disponibilidad_manana == 1) echo'M ';?>
						         		<?php if($docente->disponibilidad_tarde == 1) echo'T ';?>
										<?php if($docente->disponibilidad_noche == 1) echo'N ';?>
										<?php if($docente->disponibilidad_sabados == 1)  echo 'SAB';?>
										<?php if($docente->disponibilidad_sabados == 0 and $docente->disponibilidad_manana == 0 and $docente->disponibilidad_tarde == 0 and $docente->disponibilidad_noche == 0) echo'Ninguna';?>
						         	</td> 
									<td class="text-center">
									<a href="{{route('filial.docentes_editar',$docente->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>
									<a href="{{route('filial.docentes_borrar',$docente->id)}}" title="Borrar"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
									<a href="{{route('filial.docentes_calcularHoras',$docente->id)}}" title="Horas de clase"><i class="btn btn-info glyphicon glyphicon-time"></i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection