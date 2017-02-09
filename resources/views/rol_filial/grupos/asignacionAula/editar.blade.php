@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('grupo.editaraula')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'filial.asignacionAulas_editar_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                            	<input type="hidden" name="id" value="{{$aula->id}}">
                                <label>@lang('grupo.nombreaula')</label>   
                          
                        			{!! Form::text('nombre', $aula->nombre, array('class'=>'form-control')) !!}
                  
                            </div>

                            <div class="box-footer col-xs-12">
                                <a href="{{route('filial.asignacionAulas_nuevo')}}" class="btn btn-success">@lang('grupo.atras')</a>
                                <button type="submit" class="btn btn-success">@lang('grupo.editar')</button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection