<div class="box-tools pull-left no-print" style="margin-right: 380px;">
	<a href="{{route('filial.pagos_plan_nuevo',$matricula->id)}}" class="btn btn-success text-white"> @lang('matricula.agregarnuevopago')</a>
</div>
<?php if (isset($planPagosV)) { ?>
	<table id="example1" class="table table-bordered table-striped">
		<thead> <tr>
			<th class="text-center">@lang('matricula.vencimiento')</th>
			<th class="text-center">@lang('matricula.nro')</th>
			<th class="text-center">@lang('matricula.estado')</th>
			<th class="text-center">@lang('matricula.actual')</th>
			<th class="text-center">@lang('matricula.montooriginal')</th>
			<th class="text-center">@lang('matricula.pago')</th>
			<th class="text-center">@lang('matricula.recargo')</th>
			<!-- <th class="text-center">@lang('matricula.filial')</th> -->
			<th class="no-print"></th>
		</tr> </thead>
		<tbody>
			@foreach($planPagosV as $pago)
				<tr class="text-center">
					<td>{{$pago->vencimiento}}</td>
					<td><?php
						if($pago->nro_pago == 0) {?>
						<span> @lang('matricula.matricula') </span>
						<?php }else
						echo $pago->nro_pago;?>
					</td>
					<td>
						<?php if ($pago->terminado == 1){?>
							<span> @lang('matricula.terminado') </span>
						<?php }else{ ?>
							<span> @lang('matricula.pendiente') </span>
						<?php } ?>
					</td>
					<td><?php echo session('moneda')['simbolo']; ?>{{$pago->monto_actual}}</td>
					<td><?php echo session('moneda')['simbolo']; ?>{{$pago->monto_original}}</td>
					<td><?php
					if ($pago->monto_pago != null) echo session('moneda')['simbolo'].$pago->monto_pago;
					else echo '-';
					?></td>
					<td>%{{$pago->recargo}}</td>
					<!-- <td>{{$pago->Filial->nombre}}</td> -->
					<td>
							<?php
						if ($pago->terminado != 1){
					?>

						<a href="{{route('filial.pagos_editar',$pago->id)}}" title="Editar"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
						<a href="{{route('filial.pagos_actualizar',$pago->id)}}" title="@lang('lista.abonar')"><i class="btn-xs btn-success glyphicon glyphicon-usd"></i></a>
					<?php
						}
					?>
						<a href="{{route('filial.recibos',$pago->id)}}" title="@lang('lista.verrecibos')"><i class="btn-xs btn-warning glyphicon glyphicon-list-alt"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
<?php } elseif(isset($planPagos)){ ?>
	<table id="example1" class="table table-bordered table-striped">
		<thead> <tr>
			<th>@lang('matricula.numerodepago')</th>
			<th>@lang('matricula.vencimiento')</th>
			<th>@lang('matricula.montoapagar')</th>
			<th>@lang('matricula.descuento')</th>
			<th>@lang('matricula.recargo')</th>
			<th>@lang('matricula.descripcion')</th>
			<th class="no-print"></th>
		</tr> </thead>
		<tbody>
			@foreach($planPagos as $pago)
				<tr class="text-center">
					<td><?php
						if($pago->nro_pago == 0) {?>
							<span> @lang('matricula.matricula') </span>
					<?php }else
							echo $pago->nro_pago;?>
					</td>
					<td>{{$pago->vencimiento}}</td>
					<td>{{$pago->monto_original}}</td>
					<td>{{$pago->descuento}}</td>
					<td>{{$pago->recargo}}</td>
					<td>{{$pago->descripcion}}</td>
					<td>
						<a href="{{route('filial.pagos_borrar',$pago->id)}}" title="@lang('lista.eliminar')"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a>
						<a href="{{route('filial.pagos_editar',$pago->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
<?php } ?>