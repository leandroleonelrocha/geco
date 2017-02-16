@extends('template')

@section('content')
									<!-- Lista de Matrículas -->

	<div class="row">
    <div class="col-xs-12">
      <div class="box-tools pull-right no-print destino">
       
      </div>
    </div> <!-- Fin col -->
  </div> <!-- Fin row -->

									
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="example-modal text-center">
								<!-- <div class="modal modal-success"> -->
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
									  <div class="modal-header">
									    <h3 class="modal-title">@lang('matricula.datosmatricula')</h3>
									  </div>
									  <div class="modal-body">
									    <div class="col-xs-4">
									    	<span>@lang('matricula.numero')</span>
						    				<p>{{$matricula->id}}</p>
									    </div>
									    <div class="col-xs-4">
									    	<span>@lang('matricula.fechaalta')</span>
						    				<p>{{$matricula->created_at}}</p>
									    </div>
									    <div class="col-xs-4">
									    	<span>@lang('matricula.asesoralta')</span>
						    				<p>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</p>
									    </div>
									    <div class="col-xs-4">
									    	<span>@lang('matricula.filialalta')</span>
						    				<p>{{$matricula->Filial->nombre}}</p>
									    </div>
									    <div class="col-xs-4">
									    	<span>@lang('matricula.estado')</span>
						    				<p><?php 
											if ($matricula->terminado == 1) echo 'Terminado';
											elseif ($matricula->cancelado == 1) echo 'Cancelado';
											else echo 'Activo';
											?></p>
									    </div>
									    <div class="col-xs-4">
									    	<span>@lang('matricula.cursa')</span>
						    				<p><?php 
											if ($matricula->carrera_id != null) echo $matricula->Carrera->nombre;
											else echo $matricula->Curso->nombre;
											?></p>
									    </div>
									  </div>
									</div>
								</div>
								<!-- </div> -->
							</div>
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.plandepagos')</a></li>
									<li><a href="#tab_2" data-toggle="tab">@lang('matricula.pagosindividuales')</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										@include('rol_filial.matriculas.partials.tabla_plandepago')
									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										@include('rol_filial.matriculas.partials.tabla_pagosindividuales')
									</div><!-- /.tab-pane -->
								</div><!-- tab-content -->
							</div><!-- nav-tabs-custom -->
						</div>
					</div>
				</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

@section('js')
<script type="text/javascript">

  // alert('asdasd');
  //$("#enlaceajax").click(function(evento){
    //  evento.preventDefault();
      // $(".destino").load("{{ URL::to('/filial/carrito') }}");
   
  //}); 


</script>
@endsection