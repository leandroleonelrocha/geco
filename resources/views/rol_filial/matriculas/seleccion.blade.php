@extends('template')

@section('content')
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.listadopersona')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.matriculas_nuevaPersona')}}" class="btn btn-success text-white"> @lang('preinforme.agregarnuevapersona')</a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-xs-12">
						<div class="col-xs-9">
			            	<h4 class="box-title">
			            		@lang('preinforme.personasexistentes')
			            		<div><small>@lang('preinforme.seleccion')</small></div>
			            	</h4>
			            </div>
						<table id="example1" class="table table-bordered table-striped">
							<thead><tr>
							<th>@lang('persona.nombre')</th>
							<th>@lang('persona.apellido')</th>
							<th>@lang('persona.numerodocumento')</th>
							<th class="no-print"></th>
							</tr></thead>
							<tbody>
								@foreach($personas as $persona)
										<tr>
											<td>{{$persona->nombres}}</td>
											<td>{{$persona->apellidos}}</td>
											<td>{{$persona->nro_documento}}</td>

											<td class="text-center"><a href="{{route('filial.matriculas_nuevo',$persona->id)}}" class="btn-xs btn-success text-white">@lang('preinforme.seleccionar')</a></td>
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