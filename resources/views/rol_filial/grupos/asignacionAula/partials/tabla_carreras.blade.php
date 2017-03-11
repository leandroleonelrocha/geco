<table id="example1" class="table table-bordered table-striped">
<thead> <tr>
<th>@lang('carrera.nombre')</th>
<th>@lang('carrera.duracion')</th>
<th>@lang('carrera.descripcion')</th>
<th class="no-print"></th>
</tr> </thead>
<tbody>
	@foreach($carreras as $ca)
    	<tr role="row" class="odd">

        	<td class="sorting_1">{{ $ca->nombre }}</td>
        	<input type="hidden" value="{{$ca->id_carrera}}">
	        <td>{{ $ca->duracion }}</td>
            <td>{{ $ca->descripcion }}</td>
           	<td class="text-center">

  			<a href="{{route('filial.carreras_editar',$ca->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>	
			</td>
	    </tr>
    @endforeach
	</tbody>
</table>