<table id="tabla_morosidad" class="table table-bordered table-striped">
	<thead><tr>
		<th class="text-center">@lang('matricula.numero')</th>
		<th class="text-center">@lang('matricula.fechaalta')</th>
		<th class="text-center">@lang('matricula.asesoralta')</th>
		<th class="text-center">@lang('matricula.filialalta')</th>
		<th class="text-center">@lang('matricula.estado')</th>
		<th class="text-center">Cursa</th>
	</tr></thead>
	<tbody>
		<tr class="text-center">
			<td>{{$matricula->id}}</td>
			<td>{{$matricula->created_at}}</td>
			<td>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</td>
			<td>{{$matricula->Filial->nombre}}</td>
			<td>
				@if($matricula->terminado == 1)
					 @lang('matricula.terminado') 
				@elseif($matricula->cancelado == 1) 
					 	@lang('matricula.cancelado')
					@else
						@lang('matricula.activo')
					@endif
			</td>
			<td><?php 
					if ($matricula->carrera_id != null) echo $matricula->Carrera->nombre;
					else echo $matricula->Curso->nombre;
			?></td>
		</tr>
	</tbody>
</table>