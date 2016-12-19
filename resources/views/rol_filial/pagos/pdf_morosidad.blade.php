<table id="tabla_morosidad" class="table table-bordered table-striped">
						<thead><tr>
						<th class="text-center">Matrícula</th>
						<th class="text-center">Grupo</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Cuota</th>
						<th class="text-center">Fecha pago</th>
						<th class="text-center">Vencimiento</th>
						<th class="text-center">Saldo</th>
						<th class="text-center">Teléfonos</th>
						<th class="text-center">Correos</th>

						</tr> </thead>
						<tbody>
					    @foreach($model as $m)
					      <tr>

					        <td>{{$m['matricula']}}</td>
					        <td>{{$m['grupo']}}</td>
					        <td>{{$m['persona']}}</td>
					        <td>{{$m['nro_pago']}}</td>
					        <td>fecha pago</td>
					        <td>{{$m['saldo']}}</td>
					        <td>{{$m['vencimiento']}}</td>
					        <td>{{$m['vencimiento']}}</td>
					        
					      </tr>
					      @endforeach
						</tbody>
						</table>


</table>