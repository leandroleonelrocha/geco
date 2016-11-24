@extends('template')

@section('content')
		
						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('director.listadodirector')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('dueño.directores_nuevo')}}" class="btn btn-success text-white"> @lang('director.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('director.tipodocumento')</th>
						<th>@lang('director.numerodocumento')</th>
						<th>@lang('director.apellido')</th>
						<th>@lang('director.nombre')</th>
						<th>@lang('director.telefonos')</th> 
						<th>E-Mail</th>
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($directores as $d)
							    <tr role="row" class="odd">
				    				<td>{{$d->TipoDocumento->tipo_documento}}</td>
							      	<td>{{ $d->nro_documento}}</td>
							        <td>{{ $d->apellidos }}</td>
							        <td>{{ $d->nombres }}</td>
									<td>
							     	@foreach($d->DirectorTelefono as $telefono)
						            		{{$telefono->telefono}}</br>
					            	@endforeach</td>
					            	<td>{{$d->mail}}</td>
				      
						           	<td class="text-center">
									<a href="{{route('dueño.directores_editar',$d->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('dueño.directores_borrar',$d->id)}}" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar el director?);"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection