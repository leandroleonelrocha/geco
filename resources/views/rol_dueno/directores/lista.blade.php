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
						<th>@lang('lista.cuenta')</th>
						
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
				      				<td>

				      				@if(isset($d->Cuenta))
				      					@if($d->Cuenta->habilitado == 1 && $d->Cuenta->rol_id == 3)
				      				<a href="{{route('dueño.desactivarCuenta',['id'=>$d->id,'rol_id'=>$d->Cuenta->rol_id])}}" class="btn btn-block btn-danger btn-xs">@lang('lista.deshabilitar')</a>
				      					@endif

				      				@if($d->Cuenta->habilitado == 0 && $d->Cuenta->rol_id == 3)
				      				<a href="{{route('dueño.habilitarCuenta',['id'=>$d->id,'rol_id'=>$d->Cuenta->rol_id] )}}" class="btn btn-block btn-success btn-xs">@lang('lista.habilitar')</a>
				      					@endif
				      				
				      				@endif

				      				</td>
				      				

						           	<td class="text-center">
									<a href="{{route('dueño.directores_editar',$d->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('dueño.directores_borrar',$d->id)}}" title="@lang('lista.eliminar')" onclick="return confirm('¿Está seguro que desea eliminar el director?);"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a></td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection