<table id="example1" class="table table-bordered table-striped">
<thead> <tr>
<th class="text-center">@lang('materia.nombre')</th>
<th class="text-center">@lang('materia.carrera')</th>
<th class="text-center">@lang('matricula.cursos')</th>
<th class="text-center">@lang('materia.descripcion')</th>
<th class="no-print"></th>
</tr> </thead>
<tbody>
@foreach($materia as $m)
<tr role="row" class="odd">
<td class="sorting_1">{{ $m->nombre }}</td>
<td>
@foreach($m->MateriaCarreraCurso as $mcc)
<span class="text-success">	
<?php
	echo $mcc->Carrera['nombre'];
	?>
	</br>
</span>
@endforeach
</td>
<td>
@foreach($m->MateriaCarreraCurso as $mcc)	
<span class="text-info">
<?php
	echo $mcc->Curso['nombre'];
	?>
</span>
	</br>
@endforeach
</td>
<td>{{ $m->descripcion }}</td>
<td class="text-center">
<a href="{{route('filial.materias_editar',$m->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>	
</td>
</tr>
@endforeach
</tbody>
</table>