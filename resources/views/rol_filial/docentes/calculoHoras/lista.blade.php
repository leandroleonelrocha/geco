@extends('template')

@section('content')

	<!-- Lista de Docentes -->
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('docente.docente') <strong>{{$docente->nombres}} {{$docente->apellidos}}</strong> </br></br>@lang('docente.titulo')</h3>	
				</div>
	
				{!! Form::open(['route'=> 'filial.docentes_calcularHorasBusqueda', 'method'=>'post']) !!}
				{!! Form::hidden('docente', $docente->id, array('class'=>'form-control')) !!}
				<div class="col-md-4 form-group">
					<label>@lang('docente.fechadesde')</label>
					{!! Form::date('fecha1',null,array('class'=>'form-control')) !!}
				</div>

				<div class="col-md-4 form-group">
					<label>@lang('docente.fechahasta')</label>
					{!! Form::date('fecha2',null,array('class'=>'form-control')) !!}
				</div>

				<div class="col-md-9 form-group">
					<button type="submit" class="btn btn-success">@lang('docente.buscar')</button>

					<span class="text-success"><h3>@lang('docente.tiene')  {{$horasTotala}} @lang('docente.horasdeclase') {{$cantClasesa}} @lang('docente.clasesentotal') @lang('docente.realizadas')</h3></span> 

					<span class="text-danger"><h3>@lang('docente.tiene')  {{$horasTotalp}} @lang('docente.horasdeclase') {{$cantClasesp}} @lang('docente.clasesentotal') @lang('docente.arealizar')</h3></span> 
				</div>
				{!! Form::close() !!}
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('docente.numeroclase')</th>
						<th>@lang('docente.fecha')</th>
						<th>@lang('docente.horariodesde')</th>
						<th>@lang('docente.horariohasta')</th>
						<th>@lang('docente.descripcion')</th>

						</tr> </thead>
						<tbody>
							@foreach($clases as $c)
								<tr>
									<td>{{$c->id}}</td>
									<td>
										<?php if($c->fecha > date("Y/m/d")){ ?>	
												<span class="text-danger"> {{$c->fecha}} </span> 
										<?php }else{ ?>
												<span class="text-success"> {{$c->fecha}} </span>
										<?php } ?>	
									</td>
									<td>{{$c->horario_desde}}</td>
									<td>{{$c->horario_hasta}}</td>
									<td>{{$c->descripcion}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection