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
						<th>@lang('asesor.numerodocumento')</th>
						<th>@lang('asesor.apellido')</th>
						<th>@lang('asesor.nombre')</th>
						<th>@lang('asesor.direccion')</th>
						<th>@lang('asesor.localidad')</th>
						<th>@lang('asesor.telefonos')</th>
						<th>@lang('asesor.mail')</th>
			
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						    @foreach($asesor as $a)
							    <tr role="row" class="odd">
							      	<td>{{ $a->nro_documento}}</td>
							        <td>{{ $a->apellidos }}</td>
							        <td>{{ $a->nombres }}</td>
						          	<td>{{ $a->direccion }}</td>
						            <td>{{ $a->localidad }}</td>
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
									<a href="{{route('filial.asesores_editar',$a->id)}}" title="@lang('lista.editar')"><i class="btn btn-primary glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('filial.asesores_borrar',$a->id)}}" title="@lang('lista.eliminar')" onclick="return confirm('¿Está seguro que desea eliminar el asesor?);"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
							    </tr>
						    @endforeach
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<div class="row">
        <div class="col-sm-12">
	        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
	        	{!! $asesor->render() !!}
	        </div>
        </div>
    </div>
@endsection