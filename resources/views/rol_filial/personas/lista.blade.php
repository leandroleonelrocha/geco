@extends('template')
@section('css')
<style type="text/css">
@-webkit-keyframes girando {
  from { -webkit-transform: rotateY(0deg);    }
  to   { -webkit-transform: rotateY(-360deg); }
}

	.girando {
   -webkit-animation-name: girando;
   -webkit-animation-timing-function: linear;
   -webkit-animation-iteration-count: infinite;
   -webkit-animation-duration: 3s;
   -webkit-transform-style: preserve-3d;
}
</style>
@endsection
@section('content')
							
	<!-- <div class="alert alert-info alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <h4><i class="icon fa fa-info"></i> Alert!</h4>
   Info alert preview. This alert is dismissable.
   </div> -->

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.listadopersona')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.personas_nuevo')}}" class="btn btn-success text-white" id="explicacion_1"> @lang('persona.agregarnuevo')</a>
					</div>
					
				</div>

				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped" >
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
									<a href="{{route('filial.personas_editar',$p->id)}}" title="@lang('lista.editar')"><i class="btn btn-primary glyphicon glyphicon-pencil"></i></a>
						           	<a href="{{route('filial.personas_borrar',$p->id)}}" title="@lang('lista.eliminar')" onclick="return confirm('¿Está seguro que desea eliminar  la persona?);"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a></td>
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
	        	{!! $persona->render() !!}
	        </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
// $(".alert-dismissable").show();
// $(".alert-dismissable").delay(3000).hide(600);

$(".star_intro" ).click(function() {
	var texto ='¡Bienvenido al Tutorial de Personas!';	
	<?php
		$array = [
		    "#explicacion_1"	 	=>	"Este boton sirve para agregar una nueva persona.",
		    "#example1_length"   	=>	"Seleccione la cantidad de registros que desee ver.",
		    "#example1_filter"   	=>	"Escriba aquí para filtrar un dato a buscar.",
		    ".explicacion_editar" 	=>  "Este boton sirve para editar la persona.",
		    ".explicacion_borrar"	=>  "Este boton sirve para borrar la persona.", 
		];
	?>
	startIntro(texto);
});		
</script>
@include('partials.inicio_tutorial')
@endsection

