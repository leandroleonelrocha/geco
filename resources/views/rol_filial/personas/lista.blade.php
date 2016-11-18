@extends('template')

@section('content')
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.listadopersona')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.personas_nuevo')}}" class="btn btn-success text-white"> @lang('persona.agregarnuevo')</a>
					</div>
				</div>

				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead><tr>
						<th>@lang('persona.numerodocumento')</th>
						<th>@lang('persona.nombre')</th>
						<th>@lang('persona.apellido')</th>
						<th>@lang('persona.fnacimiento')</th>
						<th>@lang('persona.localidad')</th>
						<th>@lang('persona.telefonos')</th>
						<th>E-mails</th>
						<th>@lang('persona.disponibilidad')</th>

						<th class="no-print"></th>
						</tr></thead>
						<tbody>
							@foreach($persona as $p)
								<tr>
									<td>{{$p->nro_documento}}</td>
									<td>{{$p->nombres}}</td>
									<td>{{$p->apellidos}}</td>
									<td>{{$p->fecha_nacimiento}}</td>
									<td>{{$p->localidad}}</td>
									<td>
							     	@foreach($p->PersonaTelefono as $telefono)
						            		{{$telefono->telefono}}   </br>
					            	@endforeach</td>
					            	<td>
				            	   	@foreach($p->PersonaMail as $mail)
						            		{{$mail->mail}} </br>
					            	@endforeach</td>
							
						         	<td><?php if($p->disponibilidad_manana == 1) echo'M ';?>
						         		<?php if($p->disponibilidad_tarde == 1) echo'T ';?>
										<?php if($p->disponibilidad_noche == 1) echo'N ';?>
										<?php if($p->disponibilidad_sabados == 1)  echo 'SAB';?>
										<?php if($p->disponibilidad_sabados == 0 and $p->disponibilidad_manana == 0 and $p->disponibilidad_tarde == 0 and $p->disponibilidad_noche == 0) echo'Ninguna';?>
						         	</td>  
				

						          	<td>
									<a href="{{route('filial.personas_editar',$p->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('filial.personas_borrar',$p->id)}}" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar  la persona?);"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>	
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection