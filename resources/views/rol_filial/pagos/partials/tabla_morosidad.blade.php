<table id="example1" class="table table-bordered table-striped">
<thead><tr>
<th class="text-center">Matrícula</th>
<th class="text-center">Grupo</th>
<th class="text-center">Nombre</th>
<th class="text-center">Cuota</th>
<th class="text-center">Fecha pago</th>
<th class="text-center">Vencimiento</th>
<th class="text-center">Salgo</th>
<th class="text-center">Teléfonos</th>
<th class="text-center">Correos</th>

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