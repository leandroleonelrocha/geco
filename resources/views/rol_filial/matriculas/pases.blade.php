@extends('template')

@section('content')
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('pase.listadopases')</h3>
				</div>
				<div class="box-body">
					<!-- <div class="col-xs-12"><h4>Pases Realizados</h4></div>
					<div class="col-xs-12"><h4>Pases Emitidos</h4></div> -->
					<div class="col-xs-12">
						<table id="example1" class="table table-bordered table-striped">
							<thead><tr>
							<th>@lang('pase.matricula')</th>
							<th>@lang('pase.filial')</th>
							<th>@lang('pase.persona')</th>
							<th>@lang('pase.estado')</th>
							<th class="no-print"></th>
							</tr></thead>
							<tbody>
								@foreach($pasesRecibidos as $paseR)
								<tr>
									<td>{{$paseR->Matricula->id}}</td>
									<td>{{$paseR->Filial->nombre}}</td>
									<td>{{$paseR->Matricula->Persona->nombres}} {{$paseR->Matricula->Persona->apellidos}}</td>
									<td class="accion">
										<?php if($paseR->confirmar == 0){ ?>
											<span class="text-danger"> POR CONFIRMAR </span> 
										<?php }else{ ?>
											<span class="text-success"> CONFIRMADO </span>
										<?php } ?>
									</td>
									<td class="text-center">
										<?php if($paseR->confirmar == 0){ ?>
										<a data-url="{{route('filial.matriculas_pases_confirmar',$paseR->id)}}" class="CR" data-actividad="confirmar" data-id="{{$paseR->id}}">
											<i class="btn btn-success fa fa-thumbs-o-up" title=@lang('pase.confirmar')></i>
										</a>
										<a data-url="{{route('filial.matriculas_pases_rechazar',$paseR->id)}}" class="CR rechazar" data-actividad="rechazar" data-id="{{$paseR->id}}">
											<i class="btn btn-danger fa fa-thumbs-o-down" title="Rechazar"></i>
										</a> 
										<?php }else{ ?>
											<i class="btn btn-success glyphicon glyphicon-ok" title=@lang('pase.rechazar')></i>
										<?php } ?>
									</td>
								</tr>
								@endforeach
								@foreach($pasesEmitidos as $paseE)
										<tr>
											<td>{{$paseE->matricula}}</td>
											<td>{{$paseE->filial}}</td>
											<td>{{$paseE->nombres}} {{$paseE->apellidos}}</td>
											<td>
												<?php if($paseE->confirmar == 0){ ?>
													<span class="text-danger"> PENDIENTE </span> 
												<?php }else{ ?>
													<span class="text-success"> REALIZADO </span>
												<?php } ?>	
											</td>
											<td class="text-center"> - </td>
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