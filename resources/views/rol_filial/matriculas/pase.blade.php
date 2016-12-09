@extends('template')

@section('content')
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('filial.listadofilial')</h3>
				</div>
				<div class="box-body">
					<div class="col-xs-12">
						<table id="example1" class="table table-bordered table-striped">
							<thead><tr>
							<th>@lang('filial.nombre')</th>
							<th>Director</th>
							<th>@lang('filial.telefonos')</th>
							<th>E-Mail</th>
							<th class="no-print"></th>
							</tr></thead>
							<tbody>
								@foreach($filiales as $filial)
										<tr>
											<td>{{$filial->nombre}}</td>
											<td>{{$filial->Director->Nombres}} {{$filial->Director->apellidos}}</td>
											<td>
												@foreach($filial->FilialTelefono as $ft)
													{{$ft->telefono}}<br>
												@endforeach
											</td>
											<td>{{$filial->mail}}</td>

											<td class="text-center"><a href="{{route('filial.matriculas_pase_nuevo',[$filial->id, $matricula])}}" class="btn btn-success text-white">@lang('filial.seleccionar')</a></td>
										</tr>
								@endforeach
							</tbody>
						</table>	
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection