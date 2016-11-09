@extends('template')
@section('content')					
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de filiales</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('dueño.filiales_nuevo')}}" class="btn btn-success text-white"> Agregar nueva</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>Nombre</th>
						<th>Direcci&oacuten</th>
						<th>Localidad</th>
						<th>CP</th>
						<th>Tel&eacutefono</th>
						<th>E-Mail</th>
						<th>Director</th>
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($filiales as $f)
						
							    <tr role="row" class="odd">
							        <td class="sorting_1">{{ $f->nombre }}</td>
							        <td>{{ $f->direccion }}</td>
							        <td>{{ $f->localidad }}</td>
					                <td>{{ $f->codigo_postal }}</td>
					                <td>
			                     	@foreach($f->FilialTelefono as $telefono)
						            		{{$telefono->telefono}}
					            	@endforeach</td>
					            	<td>{{ $f->mail}}</td>
						            <td>{{ $f->Director->fullname}}</td>
						           	<td>
					           		<a href="{{route('dueño.filiales_editar',$f->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>	
				           	   		<a href="{{route('dueño.filiales_borrar',$f->id)}}" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar la filial?);"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection