@extends('template')

@section('content')
	 					
		<div class="row">
		<div class="col-xs-12">
			<div class="box-tools pull-right no-print">
						<a href="{{route('filial.pagos_nuevo',$matricula->id)}}" class="btn btn-success text-white"> @lang('matricula.agregarnuevopago')</a>
					</div>
				</div>
				<div class="box-body">
			
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->

	<div class="row">
	<div class="col-xs-12">

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.listadopago')</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Morosidad</a></li>
                </ul>

                <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
               		@include('rol_filial.pagos.partials.tabla_pagos')
                </div><!-- /.tab-pane -->
                
                <div class="tab-pane" id="tab_2">

                	<div class="form-group">
					{!! Form::open(['route'=> 'filial.tabla_morisidad', 'method'=>'post']) !!}
						 <div class="input-group input-group-sm">
		                   {!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
		                    <span class="input-group-btn">
		                      <!--<button class="btn btn-default btn-flat buscar_fecha" type="button">Buscar</button> -->
		                      
			                <button type="button" class="btn btn-default buscar_fecha">
			               		Buscar
						     	<span class="glyphicon glyphicon-search "></span> 
						    </button>

		                    </span>
		                  </div><!-- /input-group -->
		         	{!! Form::close() !!}  
		            <br>
		           

		            <div class="panel panel-default">
					  <!-- Default panel contents -->
					<div class="panel-heading clearfix">
				     	<b>Listado de morosidad</b>
				       <div class="btn-group pull-right">
				      	
				        <a href="{{route('filial.imprimir_morosidad')}}" type="button" class="btn btn-default">
			               	Imprimir
						    <span class="glyphicon glyphicon-print"></span> 
						</a>
				      
				      </div>
				  	</div>
					
					    <table id="tabla_morosidad" class="table table-bordered table-striped">
						<thead><tr>
						<th class="text-center">Matrícula</th>
						<th class="text-center">Grupo</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Cuota</th>
						<th class="text-center">Fecha pago</th>
						<th class="text-center">Vencimiento</th>
						<th class="text-center">Saldo</th>
						<th class="text-center">Teléfonos</th>
						<th class="text-center">Correos</th>

						</tr> </thead>
						<tbody>
				
						</tbody>
						</table>

					</div>
		            		

                </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
            </div>

@endsection

@section('js')
<script type="text/javascript">

	$( ".buscar_fecha" ).click(function() {
		var link = $(this);

		link.find('span').remove();
		link.append('<span class="fa fa-refresh fa-spin"></span>');
		
		var fecha = $('#reservation').val();
		var url   = "{{ URL::route('filial.tabla_morisidad') }}";
		
		$.ajax(
			{
			url: url,
			type: 'post',
			data: 'fecha='+fecha,
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result){
				
				$('#tabla_morosidad').children('tbody').empty();
				
				link.find('span').remove();
				link.append('<span class="glyphicon glyphicon-search "></span>');
				
				var body = $('#tabla_morosidad').children('tbody');
					
					$.each(result, function(clave, valor){

						console.log(valor)
						

						body.append(tr(valor.matricula, valor.grupo, valor.persona, valor.nro_pago, 'fecha', valor.vencimiento, 'saldo', 'telefono', 'mail'));
	
						
					});

			}}

		);

	});
	
	function persona_email(obj){
		var mail = new Array();
		$.each(obj, function(key, val) {
		   mail.push(val.mail);
		});	
		return mail;
	}

	function persona_telefono(obj){
		var telefono = new Array();
		$.each(obj, function(key, val) {
		   telefono.push(val.telefono);
		});	
		return telefono;
	}
	
	function table() {

		var table = '<table id="example1" class="table table-bordered table-striped">'+
					'<thead> <tr>'+
					'<th>@lang('examen.matricula')</th>'+
					'<th>@lang('examen.persona')</th>'+
					'<th>@lang('examen.nota')</th>'+
					'</tr></thead>'+
					'<tbody>'+
					'</tbody>'+
					'</table>';
		return table;
	}

	function tr(matricula, grupo, nombre, cuota, fecha_pago, fecha_vencimiento, saldo, telefono, mail) {

		var tr = '<tr>'+
				 '<td>'+ matricula + '</td>'+
				 '<td>'+ grupo + '</td>'+
				 '<td>'+ nombre + '</td>'+
				 '<td>'+ cuota + '</td>'+
				 '<td>'+ fecha_pago + '</td>'+
				 '<td>'+ fecha_vencimiento + '</td>'+
				 '<td>'+ saldo + '</td>'+
				 '<td>'+ telefono + '</td>'+
				 '<td>'+ mail + '</td>'+
				 
				 '</tr>';
		return tr;
	}



</script>
@endsection