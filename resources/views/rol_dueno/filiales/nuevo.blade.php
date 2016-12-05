@extends('template')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('filial.nuevofilial')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'dueño.filiales_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>@lang('filial.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('filial.direccion')</label>
                                {!! Form::text('direccion',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('filial.localidad')</label>
                                {!! Form::text('localidad',null,array('class'=>'form-control')) !!}
                            </div>

                           <div class="col-md-6 form-group">
                                <label>@lang('filial.codigopostal')</label>
                                {!! Form::text('codigo_postal',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('filial.cadena')</label>
                                {!! Form::select('cadena_id', $cadenas->toArray() , null, array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Director</label>
                                {!! Form::select('director_id', $directores->toArray() , null, array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('filial.telefonos')</label>
                                <button class="add_input_telefono btn-xs btn-success">+</button>   
                                <div class="input_fields_telefono">  
                                    {!! Form::text('telefono[]',null,array('class'=>'form-control')) !!}   
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-Mail</label>
                                {!! Form::email('mail',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="box-footer col-xs-12">
                            {!! Form::submit('Crear',array('class'=>'btn btn-success')) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection