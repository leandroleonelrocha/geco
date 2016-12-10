@extends('template')

@section('content')

						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('matricula.listadopago')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.pagos_nuevo',$matricula->id)}}" class="btn btn-success text-white"> @lang('matricula.agregarnuevopago')</a>
					</div>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th class="text-center">@lang('matricula.nro')</th>
						<th class="text-center">@lang('matricula.descripcion')</th>
						<th class="text-center">@lang('matricula.estado')</th>
						<th class="text-center">@lang('matricula.actual')</th>
						<th class="text-center">@lang('matricula.vencimiento')</th>
						<th class="text-center">@lang('matricula.pago')</th>
						<th class="text-center">Original</th>
						<th class="text-center">@lang('matricula.descuento')</th>
						<th class="text-center">@lang('matricula.recargo')</th>
						<th class="text-center">@lang('matricula.filial')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($pagos as $pago)
						<tr class="text-center">
							<td><?php
								if($pago->nro_pago == 0) echo 'Matrícula';
								else echo $pago->nro_pago;
							?></td>
							<td>{{$pago->descripcion}}</td>
							<td><?php
								if ($pago->terminado == 1) echo 'Terminado';
								else echo 'Pendiente';
							?></td>
							<td>${{$pago->monto_actual}}</td>
							<td>{{$pago->vencimiento}}</td>
							<td><?php
							if ($pago->monto_pago != null) echo '$'.$pago->monto_pago;
							else echo '-';
							?></td>
							<td>${{$pago->monto_original}}</td>
							<td>${{$pago->descuento}}</td>
							<td>{{$pago->recargo}}%</td>
							<td>{{$pago->Filial->nombre}}</td>
							<td>
							<?php
								if ($pago->terminado != 1){
							?>

								<a href="{{route('filial.pagos_editar',$pago->id)}}" title="@lang('lista.editar')"><i class="btn btn-primary glyphicon glyphicon-pencil"></i></a>
								<a href="{{route('filial.pagos_actualizar',$pago->id)}}" title="@lang('lista.actualizar')"><i class="btn btn-success glyphicon glyphicon-repeat"></i></a>

							<?php
								}
							?>
								<a href="{{route('filial.recibos',$pago->id)}}" title="@lang('matricula.verrecibos')"><i class="btn btn-warning glyphicon glyphicon-list-alt"></i></a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection