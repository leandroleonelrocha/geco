@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('grupo.asignacionaulas')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-tabs-custom col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">@lang('grupo.asignaraulas')</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">@lang('grupo.aulasasignadasengrupos')</a></li>    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">

                                        {!! Form::open(['route'=> 'filial.asignacionAulas_nuevo_post', 'method'=>'post']) !!}
                                        <div class="col-md-6 form-group">
                                            <label>@lang('grupo.nombreaula')</label>
                                            <button class="add_input_nombre btn-xs btn-success">+</button>   
                                            <div class="input_fields_nombre">
                                                <input type="text" name="nombre[]" class="form-control" placeholder="20, AA30">
                                            </div>
                                        </div>

                                        <div class="box-footer col-xs-12">
                                            <button type="submit" class="btn btn-success">@lang('grupo.crear')</button>
                                        </div>
                                        {!! Form::close() !!}

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead> <tr>
                                                <th>@lang('grupo.listaaulasasignadas')</th>
                                            <th class="no-print"></th>
                                            </tr> </thead>
                                            <tbody>
                                                @foreach($aulas as $a)
                                                    <tr role="row" class="odd">
                                                   
                                                        <td class="sorting_1">{{$a->nombre}}</td>

                                                        <td class="text-center">
                                                        <a href="{{route('filial.asignacionAulas_editar',$a->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>  </td>                     
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_2">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead> <tr>
                                                <th>@lang('grupo.grupo')</th>
                                                <th>@lang('grupo.horacomienzo')</th>
                                                <th>@lang('grupo.horafin')</th>
                                                <th>@lang('grupo.listaaulasasignadas')</th>
                                            </tr> </thead>
                                            <tbody>
                                                @foreach($grupos as $g)
                                                @foreach($g->GrupoHorario as $gh)
                                                    <tr role="row" class="odd">
                                                   
                                                        <td class="sorting_1">{{$gh->Grupo->descripcion}}</td>
                                                        <td>{{$gh->horario_desde}}</td>
                                                        <td>{{$gh->horario_hasta}}</td>
                                                        <td><span class="text-success">{{$gh->Aula->nombre}}</span></td>                   
                                                    </tr>
                                                 @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
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