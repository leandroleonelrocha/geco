<table id="example1" class="table table-bordered table-striped">
<thead><tr>
<th class="text-center">@lang('matricula.nro')</th>
<th class="text-center">@lang('matricula.descripcion')</th>
<th class="text-center">@lang('matricula.estado')</th>
<th class="text-center">@lang('matricula.actual')</th>
</tr> </thead>
<tbody>
@foreach($pagos as $pago)
<tr class="text-center">
<td>${{$pago->monto_original}}</td>
<td>${{$pago->descuento}}</td>
<td>{{$pago->recargo}}%</td>
<td>{{$pago->Filial->nombre}}</td>
</tr>
@endforeach
</tbody>
</table>