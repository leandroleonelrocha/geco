@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('director.nuevodirector')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'dueño.directores_nuevo_post', 'method'=>'post']) !!}

                            <div class="col-md-6 form-group">
                                <label>@lang('director.tipodocumento')</label>
                                {!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('director.numerodocumento')</label>
                                {!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('director.apellido')</label>
                                {!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('director.nombre')</label>
                                {!! Form::text('nombres',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('director.telefonos')</label>
                                <button class="add_input_telefono btn btn-success">+</button>   
                                <div class="input_fields_telefono">
                                    <input type="text" name="telefono[]" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-Mail</label>
                                {!! Form::email('mail',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="box-footer col-xs-12">
                                <button type="submit" class="btn btn-success">@lang('director.crear')</button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection