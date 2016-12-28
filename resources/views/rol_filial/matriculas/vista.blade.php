@extends('template')

@section('content')
									<!-- Lista de Matrículas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.datosmatricula')</a></li>
									<li><a href="#tab_2" data-toggle="tab">@lang('matricula.listadopago')</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										@include('rol_filial.matriculas.partials.tabla_datosmatricula')
									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										@include('rol_filial.matriculas.partials.tabla_listadopagos')
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