@extends('template')

@section('content')
									<!-- Lista de Preinformes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('preinforme.listadopreinforme')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.preinformes_seleccion')}}" id="step1" class="btn btn-success text-white"> @lang('preinforme.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('preinforme.numero')</th>
						<th>@lang('persona.asesor')</th>
						<th>@lang('preinforme.persona')</th>
						<th>Medio</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($preinformes as $preinforme)
							<tr>
								<td>{{$preinforme->id}}</td>
								<td>{{$preinforme->Asesor->nombres}} {{$preinforme->Asesor->apellidos}}</td>
								<td>{{$preinforme->Persona->nombres}} {{$preinforme->Persona->apellidos}}</td>
								<td>{{$preinforme->medio}}</td>
								<td class="text-center"><a href="{{route('filial.preinformes_editar',$preinforme->id)}}" title="Editar"><i class="btn-xs btn-success glyphicon glyphicon-pencil"></i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
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
	var texto ='¡Bienvenido al Tutorial de Preinformes!';	
	<?php
		$array = [
		    // "#explicacion_1"	 	=>	"Este boton sirve para agregar una nueva persona.",
		    "#example1_length"   	=>	"Seleccione la cantidad de registros que desee ver.",
		    "#example1_filter"   	=>	"Escriba aquí para filtrar un dato a buscar.",
		    // ".explicacion_editar" 	=>  "Este boton sirve para editar la persona.",
		    // ".explicacion_borrar"	=>  "Este boton sirve para borrar la persona.", 
		];
	?>
	startIntro(texto);
});		
</script>
@include('partials.inicio_tutorial')
@endsection