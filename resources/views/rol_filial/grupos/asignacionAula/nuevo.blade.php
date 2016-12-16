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
                            {!! Form::open(['route'=> 'filial.asignacionAulas_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>@lang('grupo.nombreaula')</label>
                                <button class="add_input_nombre btn-xs btn-success">+</button>   
                                <div class="input_fields_nombre">
                                    <input type="text" name="nombre[]" class="form-control" placeholder="Exemplo 20, AA30">
                                </div>
                            </div>

                            <div class="box-footer col-xs-12">
                                <button type="submit" class="btn btn-success">@lang('grupo.crear')</button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection