@extends('template')

@section('content')

						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('materia.listadodemateria')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.materias_nuevo')}}" class="btn btn-success text-white"> @lang('materia.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
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
      	            		        <td><?php if(isset($m->Carrera->nombre)) echo $m->Carrera->nombre; else echo "-"; ?></td>
      	            		        <td><?php if(isset($m->Curso->nombre)) echo $m->Curso->nombre;  else echo "-"; ?></td>
						            <td>{{ $m->descripcion }}</td>
						           	<td class="text-center">

					           		<a href="{{route('filial.materias_editar',$m->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>	
									</td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->

@endsection