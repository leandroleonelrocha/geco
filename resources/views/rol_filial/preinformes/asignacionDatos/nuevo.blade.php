@extends('template')

@section('dashboard')
<h1>@lang('preinforme.asignardatos')
            <small>Control panel</small>
          </h1>
@endsection


@section('content')

         <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-tabs-custom">
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
@endsection