@extends('template')

@section('content')
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.listadoasesor')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.asesores_nuevo')}}" class="btn btn-success text-white"> @lang('asesor.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('asesor.documento')</th>
						<th>@lang('asesor.nombre')</th>
						<th>@lang('asesor.telefonos')</th>
						<th>@lang('asesor.mail')</th>
			
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($asesores as $a)
							    <tr role="row" class="odd">
							      	<td>{{ $a->TipoDocumento->tipo_documento}} {{$a->nro_documento}}</td>
							        <td>{{ $a->apellidos }} {{ $a->nombres }}</td>
						           	<td>

					            	@foreach($a->AsesorTelefono as $telefono)
						            		{{$telefono->telefono}} <br>
					            	@endforeach
						            </td>
						            <td>
						            	@foreach($a->AsesorMail as $mail)
						            		{{$mail->mail}}<br>
						            	@endforeach
						            </td>
					

						           	<td>
									<a href="{{route('filial.asesores_editar',$a->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('filial.asesores_borrar',$a->id)}}" title="@lang('lista.eliminar')" onclick="return confirm('¿Está seguro que desea eliminar el asesor?);"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a></td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection