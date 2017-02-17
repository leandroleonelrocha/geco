@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('preinforme.asignardatos')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
							<div class="nav-tabs-custom col-xs-12">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">Medios</a></li>
									
									<li><a href="#tab_2" data-toggle="tab">@lang('preinforme.encontro')</a></li>	
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
                                        @include('rol_filial.preinformes.asignacionDatos.partials.medio')
									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
                                        @include('rol_filial.preinformes.asignacionDatos.partials.comoEncontro')
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