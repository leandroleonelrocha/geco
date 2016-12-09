@extends('template')

@section('content')
									<!-- Lista de Personas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.listadopersona')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.preinformes_nuevaPersona')}}" class="btn btn-success text-white explicacion_seleccion3"> @lang('preinforme.agregarnuevapersona')</a>
					</div>
				</div>
				<div class="box-body explicacion_seleccion">
					<div class="col-xs-12">
						<div class="col-xs-9">
			            	<h4 class="box-title">
			            		@lang('preinforme.personasexistentes')
			            		<div><small>@lang('preinforme.seleccion')</small></div>
			            	</h4>
			            </div>
						<table id="example1" class="table table-bordered table-striped">
							<thead><tr>
							<th>@lang('persona.nombre')</th>
							<th>@lang('persona.apellido')</th>
							<th>@lang('persona.numerodocumento')</th>
							<th class="no-print"></th>
							</tr></thead>
							<tbody>
								@foreach($personas as $persona)
										<tr>
											<td>{{$persona->nombres}}</td>
											<td>{{$persona->apellidos}}</td>
											<td>{{$persona->nro_documento}}</td>
											<td class="text-center explicacion_seleccion2"><a href="{{route('filial.preinformes_nuevo',$persona->id)}}" class="btn-xs btn-success text-white">@lang('preinforme.seleccionar')</a></td>
										</tr>
								@endforeach
							</tbody>
						</table>	
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
@section('js')
<script type="text/javascript">
// $(".alert-dismissable").show();
// $(".alert-dismissable").delay(3000).hide(600);

$(".star_intro" ).click(function() {
	var texto ='¡Bienvenido al Tutorial de Selección de Preinformes!';	
	<?php
		$array = [
		    ".explicacion_seleccion" 	=>  "Listados de personas existentes en el sistema.",
		    ".explicacion_seleccion2"	=>  "Seleccione una persona para crearle un preinforme.",
		    ".explicacion_seleccion3"	=>  "Si la persona no ha sido cargada, haga click aquí para crear tanto a la persona como el preinforme.", 
		];
	?>
	startIntro(texto);
});		
</script>
@include('partials.inicio_tutorial')
@endsection