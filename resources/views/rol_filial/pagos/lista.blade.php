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
		                      <button class="btn btn-default btn-flat" type="button">Buscar</button>
		                    </span>
		                  </div><!-- /input-group -->
		         	{!! Form::close() !!}  
		            
		            <p>Listado de morosidad</p>
		             

            		@include('rol_filial.pagos.partials.tabla_morosidad')

                </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
            </div>

@endsection