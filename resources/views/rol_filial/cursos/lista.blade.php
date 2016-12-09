@extends('template')

@section('content')
	
						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('curso.listadodecursos')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.cursos_nuevo')}}" class="btn btn-success text-white"> 
						@lang('curso.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('curso.nombre')</th>
						<th>@lang('curso.duracion')</th>
						<th>@lang('curso.descripcion')</th>
						<th>@lang('curso.taller')</th>
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($curso as $c)
							    <tr role="row" class="odd">

							        <td class="sorting_1">{{ $c->nombre }}</td>
						        	<input type="hidden" value="{{$c->id_curso}}">
							        <td>{{ $c->duracion }}</td>
						            <td>{{ $c->descripcion }}</td>
						            <td><?php if($c->taller == 0) echo 'No Asiste'; else echo 'Si Asiste';?></td> 
						  			<td class="text-center">
					           		<a href="{{route('filial.cursos_editar',$c->id)}}" title="@lang('lista.editar')"><i class="btn btn-primary glyphicon glyphicon-pencil"></i></a>		
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
