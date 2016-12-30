<div class="box-tools pull-left no-print" style="margin-right: 380px;">
	<a href="{{route('filial.pagos_nuevo',$matricula->id)}}" class="btn btn-success text-white"> @lang('matricula.agregarnuevopago')</a>
</div>
<table id="example2" class="table table-bordered table-striped">
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
				<td>{{$pago->nro_pago}}</td>
				<td>{{$pago->vencimiento}}</td>
				<td>{{$pago->monto_original}}</td>
				<td>{{$pago->descuento}}</td>
				<td>{{$pago->recargo}}</td>
				<td>{{$pago->descripcion}}</td>
				<td>borrar/editar</td>
			</tr>
		@endforeach
	</tbody>
</table>