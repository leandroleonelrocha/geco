@extends('template')

@section('content')

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><em class="fa fa-edit"></em>@lang('grupo.asignaraulas')</a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><em class="fa fa-table"></em>@lang('grupo.aulasasignadasengrupos')</a></li>
                                    <li><a href="#tab_3" data-toggle="tab"><em class="fa fa-folder"></em>Carreras</a></li>
                                    <li><a href="#tab_4" data-toggle="tab"><em class="fa fa-tasks"></em>Cursos</a></li>
                                    <li><a href="#tab_5" data-toggle="tab"><em class="fa fa-book"></em>Materias</a></li>


                                        
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">

                                        @include('rol_filial.grupos.asignacionAula.partials.asignarAulas')
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_2">
                                         <h2>Listado de aulas asignadas</h2>
                                        @include('rol_filial.grupos.asignacionAula.partials.AulasGrupos')
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_3">
                                        <h2>Listado de carreras</h2>
                                                <a href="{{route('filial.carreras_nuevo')}}" class="btn btn-default btn-flat pull-right">
                                                    <em class="fa fa-plus-circle text-primary"></em> @lang('carrera.agregarnuevo')
                                                </a>
                                         
                                        
                                         @include('rol_filial.grupos.asignacionAula.partials.tabla_carreras')
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_4">
                                       <h2>Listado de cursos</h2>
                                       <a href="{{route('filial.cursos_nuevo')}}" class="btn btn-default pull-right"> 
                                       <em class="fa fa-plus-circle text-primary"></em> 
                                       @lang('curso.agregarnuevo')</a>

                                        @include('rol_filial.grupos.asignacionAula.partials.tabla_cursos')
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_5">
                                        <h2>Listado de materias</h2>
                                        <a href="{{route('filial.materias_nuevo')}}" class="btn btn-default pull-right"><em class="fa fa-plus-circle text-primary"></em>  @lang('materia.agregarnuevo')</a>
                                        
                                        @include('rol_filial.grupos.asignacionAula.partials.tabla_materias')
                                    </div><!-- /.tab-pane -->

                                </div>
                            </div>
                        </div>
                    </div>



@endsection