<table id="example1" class="table table-bordered table-striped">
<thead> <tr>
<th>@lang('curso.nombre')</th>
<th>@lang('curso.duracion')</th>
<th>@lang('curso.descripcion')</th>
<th>@lang('curso.taller')</th>
<th class="no-print"></th>
</tr> </thead>
<tbody>
@foreach($cursos as $c)
<tr role="row" class="odd">

<td class="sorting_1">{{ $c->nombre }}</td>
<input type="hidden" value="{{$c->id_curso}}">
<td>{{ $c->duracion }}</td>
<td>{{ $c->descripcion }}</td>

<td>
<?php if($c->taller == 0){ ?>
<span> @lang('curso.noasiste') </span> 
<?php }else{ ?>
<span> @lang('curso.siasiste') </span>
<?php } ?>
</td>

<td class="text-center">

<a href="{{route('filial.cursos_editar',$c->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>		

</td>
</tr>
@endforeach
</tbody>
</table>