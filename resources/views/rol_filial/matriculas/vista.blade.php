@extends('template')

@section('content')

									
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-lg-12 col-xs-12">
			              <!-- small box -->
			              <div class="small-box bg-green">
			                <div class="inner">
			                  <div class="row">
			                    <div class="col-sm-4 border-right">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.numero')</h5>
			                        <span class="description-text">{{$matricula->id}}</span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                    <div class="col-sm-4 border-right">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.fechaalta')</h5>
			                        <span class="description-text">{{$matricula->created_at}}</span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                    <div class="col-sm-4">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.asesoralta')</h5>
			                        <span class="description-text">{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                  </div>

			                   <div class="row">
			                    <div class="col-sm-4 border-right">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.filialalta')</h5>
			                        <span class="description-text">{{$matricula->Filial->nombre}}</span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                    <div class="col-sm-4 border-right">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.estado')</h5>
			                        <span class="description-text"><?php 
											if ($matricula->terminado == 1) echo 'Terminado';
											elseif ($matricula->cancelado == 1) echo 'Cancelado';
											else echo 'Activo';
											?></span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                    <div class="col-sm-4">
			                      <div class="description-block">
			                        <h5 class="description-header">@lang('matricula.cursa')</h5>
			                        <span class="description-text">
			                        	<?php 
											if ($matricula->carrera_id != null) echo $matricula->Carrera->nombre;
											else echo $matricula->Curso->nombre;
											?>
			                        </span>
			                      </div><!-- /.description-block -->
			                    </div><!-- /.col -->
			                  </div>


			                </div>
			               
			              </div>
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

@section('modal')
@include('rol_filial.matriculas.partials.carrito')
@endsection

@section('js')
<script type="text/javascript">
	$('#ModalEdit').click(function(){

	// elimino la session y recargo		
   //location.reload();
        });
</script>
@endsection