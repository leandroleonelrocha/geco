@extends('template')

@section('content')
					
	<div class="row">
		<div class="col-xs-12">
			
			<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.listadomatricula')</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Morosidad</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Libro IVA</a></li>
                </ul>

                <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
               		<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('matricula.numero')</th>
						<th>@lang('matricula.asesor')</th>
						<th>@lang('matricula.persona')</th>
						<th>@lang('matricula.terminado')</th>
						<th>@lang('matricula.cancelado')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($matriculas as $matricula)
							<tr>
								<td>{{$matricula->id}}</td>
								<td>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</td>
								<td>{{$matricula->Persona->apellidos}} {{$matricula->Persona->nombres}}</td>
								<td>
									<?php if($matricula->terminado == 0) echo 'No'; else echo 'Si';?>
								</td>
								<td>
									<?php if($matricula->cancelado == 0) echo 'No'; else echo 'Si';?>
								</td>
								<td class="text-center">

								<a href="{{route('filial.pagos',$matricula->id)}}" class="btn btn-success">@lang('matricula.verpagos')</a>

								</td>
							</tr>
						@endforeach
						</tbody>
					</table>	
                </div><!-- /.tab-pane -->
                
                <div class="tab-pane" id="tab_2">

                	<div class="form-group">
					{!! Form::open(['route'=> 'filial.tabla_morisidad', 'method'=>'post']) !!}
						 <div class="input-group input-group-sm">
		                   {!! Form::text('fecha', null ,  array('class'=>'form-control daterangerp')) !!}
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
				      	
				        <a href="{{route('filial.imprimir_morosidad')}}" target="_blank" type="button" class="btn btn-default">
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

                <div class="tab-pane" id="tab_3">

                	<div class="form-group">
					{!! Form::open(['route'=> 'filial.tabla_morisidad', 'method'=>'post']) !!}
						 <div class="input-group input-group-sm">
		                   {!! Form::text('fecha', null ,  array('class'=>'form-control daterangerp')) !!}
		                    <span class="input-group-btn">
		                      <!--<button class="btn btn-default btn-flat buscar_fecha" type="button">Buscar</button> -->
		                      
			                <button type="button" class="btn btn-default buscar_iva">
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
				     	<b>Libro IVA</b>
				       <div class="btn-group pull-right">
				      	
				        <a href="{{route('filial.imprimir_morosidad')}}" target="_blank" type="button" class="btn btn-default">
			               	Imprimir
						    <span class="glyphicon glyphicon-print"></span> 
						</a>
				      
				      </div>
				  	</div>
					
					    <table id="tabla_morosidad" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th class="text-center">Fecha</th>
							<th class="text-center">Recibo</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Importe</th>
						</tr>
						</thead>
						<tbody>
				
						</tbody>
						</table>

					</div>
		            		

                </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->

              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/functions/buscar_morosos.js')}}"></script>
<script type="text/javascript" src="{{asset('js/functions/buscar_libro_iva.js')}}"></script>
@endsection