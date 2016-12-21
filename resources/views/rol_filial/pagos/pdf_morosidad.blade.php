<table>
   <tr>
      <td>Números de Teléfono</td>

   </tr>

						<thead>
						<tr>
						<th >Matrícula</th>
						<th >Grupo</th>
						<th >Nombre</th>
						<th >Cuota</th>
						<th >Fecha pago</th>
						<th >Vencimiento</th>
						<th >Saldo</th>
						<th>Teléfonos</th>
						<th >Correos</th>
						</tr> 
						</thead> 
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

						